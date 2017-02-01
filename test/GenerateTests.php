<?php
require_once realpath(dirname(__FILE__) . '/caliper/CaliperTestCase.php');

use IMSGlobal\Caliper\util\TypeUtil;

function stringEndsWith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}

/**
 * Recursively process fixture JSON, producing nested arrays that represent the PHP
 * code required to instantiate Caliper classes and to set their properties.
 *
 * This code seems to have a lot of similarities to that which could be used to
 * deserialize event JSON into Caliper objects.  If PHP had better type support,
 * introspection could eliminate some of the special cases in this code.
 *
 * @param $fixture array Parsed fixture JSON with objects as "associative" arrays.
 * @return array Nested arrays of PHP code to instantiate Caliper classes
 */
function createClassCode(array $fixture) {
    $id = (@$fixture['uuid']) ? $fixture['uuid'] : ((@$fixture['id']) ? $fixture['id'] : null);
    if (is_string($id)) $id = "'$id'";

    $type = $fixture['type'];
    if (stringEndsWith($type, 'Event')) $type = "IMSGlobal\\Caliper\\events\\$type";

    $code = ["(new $type($id))"];
    $setters = [];

    foreach ($fixture as $property => $value) {
        if (in_array($property, ['type', 'id', 'uuid', '@context'])) continue;

        $propertyCapitalized = ucfirst($property);
        $setterCode = "->set$propertyCapitalized(";

        if (TypeUtil::isStringKeyedArray($value)) {
            $setters[] = $setterCode;
            $setters[] = createClassCode($value);
            $setters[] = ')';
        } else {
            if (is_array($value))
                if ('roles' === $property) {
                    $value = implode(', ', array_map(
                        function ($role) {
                            return 'new Role(Role::' . strtoupper($role) . ')';
                        },
                        $value));
                } else
                    $value = json_encode($value); // Cheating?
            elseif (is_string($value)) {
                if (stristr($property, 'date') !== false || stristr($property, 'time') !== false)
                    $value = "new \\DateTime('$value')";
                elseif (in_array($property, ['action', 'status']))
                    $value = "new $propertyCapitalized($propertyCapitalized::" . strtoupper($value) . ')';
                else
                    $value = "'$value'";
            }

            $setters[] = $setterCode . $value . ')';
        }
    }

    $code[] = $setters;
    return $code;
}

function formatArrayIndented(array $array, $indent, $additionalIndent = 4) {
    $formatted = [];

    foreach ($array as $item) {
        if (is_array($item))
            $formatted = array_merge($formatted,
                formatArrayIndented($item, $indent + $additionalIndent, $additionalIndent));
        else
            $formatted[] = str_pad(null, $indent) . $item . PHP_EOL;
    }

    return $formatted;
}

$prolog = '<?php
require_once realpath(dirname(__FILE__) . \'/../CaliperTestCase.php\');

/**
 * @requires PHP 5.4
 */
class %sTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
';

$epilog = '        );
    }
}

';

$pathToGeneratedTests = 'test/caliper/generatedTests';

$programName = array_shift($argv);
foreach ($argv as $fixtureFullPathAndFilename) {
    print "$fixtureFullPathAndFilename..." . PHP_EOL;

    $className = ltrim(basename($fixtureFullPathAndFilename, '.json'), 'a..z'); // Also removes "caliper" prefix

    $fixtureJson = false;
    try {
        $fixtureJson = @file_get_contents($fixtureFullPathAndFilename);
    } catch (Exception $exception) {
        $fixtureJson = $exception;
    }

    if (!is_string($fixtureJson)) {
        print "Error getting contents of $fixtureFullPathAndFilename." . PHP_EOL;
        if (false !== $fixtureJson) {
            print_r($fixtureJson);
        }
        continue;
    }

    $assoc = true;
    $fixture = json_decode($fixtureJson, $assoc); // returns null on error

    $testCode = [sprintf($prolog, $className)];
    $testCode = array_merge($testCode, formatArrayIndented(createClassCode($fixture), 12));
    $testCode[] = $epilog;

    // TODO: Handle errors and exceptions
    file_put_contents($pathToGeneratedTests . DIRECTORY_SEPARATOR . $className . '.php', $testCode);
}
