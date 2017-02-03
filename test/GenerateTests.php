<?php
require_once realpath(dirname(__FILE__) . '/caliper/CaliperTestCase.php');

use IMSGlobal\Caliper\util\StringUtil;
use IMSGlobal\Caliper\util\Type;

/**
 * Recursively process fixture JSON, producing nested arrays that
 * represent the PHP code required to instantiate Caliper classes and
 * to set their properties.
 *
 * This code has a lot in common with that which could deserialize
 * event JSON into Caliper objects.  Most, if not all, of the tests
 * could be done by deserializing each JSON fixture to Caliper objects,
 * serializing them back to JSON, and comparing the new JSON to the
 * fixture.
 *
 * If PHP had better type support, introspection could eliminate some
 * of the special cases in this code.
 *
 * @param $fixture array Parsed fixture JSON with objects as "associative" arrays.
 * @return array Nested arrays of PHP code to instantiate Caliper classes
 */

function createClassCode(array $fixture) {
    $code = [];
    $setters = [];

    if (Type::isStringKeyedArray($fixture)) {
        $id = (@$fixture['id']) ? $fixture['id'] : null;
        if (is_string($id)) $id = "'" . escapeshellcmd($id) . "'";

        $type = @$fixture['type'] ?: 'UnknownType';
        //$type = $fixture['type'];

        print "type: $type; ID: $id; " . PHP_EOL; // TODO: remove debug

        $code[] = "(new $type($id))";
    } else {
        print "Nope, not an object!" . PHP_EOL;
    }

    foreach ($fixture as $property => $value) {
        if (in_array($property, ['type', 'id', '@context'])) continue;

        $propertyCapitalized = ucfirst($property);
        $setterCode = "->set$propertyCapitalized(";


        if (Type::isStringKeyedArray($value)) {
            $setters[] = $setterCode;
            $setters[] = createClassCode($value);
            $setters[] = ')';
        } else {
            if (is_array($value))
                if ('extensions' === $property) {
                    $value = var_export($value, $returnString = true);
                } elseif ('roles' === $property) {
                    $value = '[' . implode(', ', array_map(
                            function ($role) {
                                return 'new Role(Role::' . strtoupper($role) . ')';
                            },
                            $value)) . ']';
                } else {
                    if (Type::isStringKeyedArray($value[0])) {
                        $objects = [];
                        foreach ($value as $object) {
                            print "calling createClassCode() for $property" . PHP_EOL; // TODO: remove debug
                            $objects[] = createClassCode($object);
                        }
                        $value = $objects;
                    } else {
                        $value = json_encode($value); // Cheating?
                    }
                }
            elseif
            (is_string($value)) {
                if (stristr($property, 'date') !== false || stristr($property, 'time') !== false)
                    $value = "new \\DateTime('$value')";
                elseif (in_array($property, ['action', 'status']))
                    $value = "new $propertyCapitalized($propertyCapitalized::" . strtoupper($value) . ')';
                else {
                    $value = "'" . escapeshellcmd($value) . "'";
                }
            }

            if (is_array($value)) {
                $setters[] = $setterCode . '[';
                $setters[] = $value;
                $setters[] = '])';
            } else
                $setters[] = $setterCode . $value . ')';
        }
    }

    $code[] = $setters;
    return $code;
}

function formatArrayIndented(array $array, $indent, $additionalIndent = 4, $append = null) {
    $formatted = [];
    $previousItem = false;

    foreach ($array as $item) {
        if (is_array($item)) {
            $formatted = array_merge($formatted,
                formatArrayIndented(
                    $item, $indent + $additionalIndent, $additionalIndent,
                    (StringUtil::endsWith($previousItem, '[')) ? ',' : null));
            $previousItem = end($formatted);
        } else {
            $previousItem = $formatted[] = str_pad(null, $indent) . $item . $append;
        }
    }

    return $formatted;
}

$indentationSpaces = 4;
$prolog = '<?php
require_once realpath(dirname(__FILE__) . \'/../CaliperTestCase.php\');

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\DigitalResource;
use IMSGlobal\Caliper\entities\DigitalResourceType;
use IMSGlobal\Caliper\entities\EntityType;
use IMSGlobal\Caliper\entities\LearningContext;
use IMSGlobal\Caliper\entities\LearningObjective;
use IMSGlobal\Caliper\entities\agent\Organization;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\annotation\AnnotationType;
use IMSGlobal\Caliper\entities\annotation\BookmarkAnnotation;
use IMSGlobal\Caliper\entities\annotation\HighlightAnnotation;
use IMSGlobal\Caliper\entities\annotation\SharedAnnotation;
use IMSGlobal\Caliper\entities\annotation\TagAnnotation;
use IMSGlobal\Caliper\entities\annotation\TextPositionSelector;
use IMSGlobal\Caliper\entities\assessment\Assessment;
use IMSGlobal\Caliper\entities\assessment\AssessmentItem;
use IMSGlobal\Caliper\entities\assignable\AssignableDigitalResource;
use IMSGlobal\Caliper\entities\assignable\AssignableDigitalResourceType;
use IMSGlobal\Caliper\entities\assignable\Attempt;
use IMSGlobal\Caliper\entities\lis\CourseOffering;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Group;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\media\AudioObject;
use IMSGlobal\Caliper\entities\media\ImageObject;
use IMSGlobal\Caliper\entities\media\MediaLocation;
use IMSGlobal\Caliper\entities\media\MediaObjectType;
use IMSGlobal\Caliper\entities\media\VideoObject;
use IMSGlobal\Caliper\entities\outcome\Result;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\reading\EPubChapter;
use IMSGlobal\Caliper\entities\reading\EPubPart;
use IMSGlobal\Caliper\entities\reading\EPubVolume;
use IMSGlobal\Caliper\entities\reading\Frame;
use IMSGlobal\Caliper\entities\reading\Reading;
use IMSGlobal\Caliper\entities\reading\WebPage;
use IMSGlobal\Caliper\entities\response\FillinBlankResponse;
use IMSGlobal\Caliper\entities\response\MultipleChoiceResponse;
use IMSGlobal\Caliper\entities\response\MultipleResponseResponse;
use IMSGlobal\Caliper\entities\response\ResponseType;
use IMSGlobal\Caliper\entities\response\SelectTextResponse;
use IMSGlobal\Caliper\entities\response\TrueFalseResponse;
use IMSGlobal\Caliper\entities\session\Session;

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
foreach ($argv as $fixturePathAndFilename) {
    print "Processing $fixturePathAndFilename..." . PHP_EOL;

    $className = ltrim(basename($fixturePathAndFilename, '.json'), 'a..z');

    $fixtureJson = false;
    try {
        $fixtureJson = @file_get_contents($fixturePathAndFilename);
    } catch (Exception $exception) {
        $fixtureJson = $exception;
    }

    if (!is_string($fixtureJson)) {
        print "Error getting contents of $fixturePathAndFilename." . PHP_EOL;
        if (false !== $fixtureJson) {
            print_r($fixtureJson);
        }
        continue;
    }

    $fixture = json_decode($fixtureJson, $asAssociativeArray = true);

    if (is_null($fixture)) {
        print "Error decoding JSON from $fixturePathAndFilename." . PHP_EOL;
        continue;
    }

    $testCode = [sprintf($prolog, $className)];
    $testCode = array_merge(
        $testCode, formatArrayIndented(createClassCode($fixture), 12, $indentationSpaces));
    $testCode[] = $epilog;

    $testClassPathAndFilename = $pathToGeneratedTests . DIRECTORY_SEPARATOR . $className . 'Test.php';
    // TODO: Handle errors and exceptions
    file_put_contents($testClassPathAndFilename, implode(PHP_EOL, $testCode));
    print "Saved $testClassPathAndFilename" . PHP_EOL;
}
