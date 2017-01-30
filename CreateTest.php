<?php
function stringEndsWith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, $strlen - $testlen, $testlen) === 0;
}

/**
 * @param $fixture
 * @return string
 */
function createClassCode($fixture) {
    $type = @$fixture['type'];

    // FIXME: Handle this better!  See the test inside the `foreach()` loop below
    // If there isn't a known type, the array may be a simple array of objects rather than an object itself.
    // E.g., the "roles" property of the "membership" object.
    $type = $type ?: 'UnknownType';

    $id = (@$fixture['uuid']) ? $fixture['uuid'] : ((@$fixture['id']) ? $fixture['id'] : null);

    $code = ["(new $type('$id'))"];
    $setters = [];

    foreach ($fixture as $property => $value) {
        if (in_array($property, ['type', 'id', 'uuid', '@context'])) continue;

        $setterCode = '->set' . ucfirst($property) . '(';

        // FIXME: Not all arrays are the same!  Add another test case here.
        // Arrays with string keys are objects
        // Arrays without string keys are simple arrays
        if (is_array($value)) {
            $setters[] = $setterCode;
            $setters[] = createClassCode($value);
            $setters[] = ')';
        } else {
            // FIXME: Handle setting Actions, Roles, and other types from enum
            // FIXME: If the property is date/time, create call to DateTime constructor
            $setters[] = $setterCode . "'${value}')";
        }
    }

    $code[] = $setters;
    return $code;
}

$fixtureFilename = $argv[1];
$fixtureJson = file_get_contents($fixtureFilename);

$assoc = true;
$fixtures = json_decode($fixtureJson, $assoc);

if (!is_array($fixtures)) {
    $fixtures = [$fixtures];
}

$code = createClassCode($fixtures);

// FIXME: Change the following code to indent nested levels
function printItem($item, $key) {
    echo "$item\n";
}

print "<?php\n";
array_walk_recursive($code, 'printItem');
print "//";



