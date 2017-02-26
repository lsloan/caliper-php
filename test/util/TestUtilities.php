<?php

/**
 * Class TestUtilities
 *
 * Requires PHP 5.6.6 or greater for the "JSON_PRESERVE_ZERO_FRACTION" constant.  This isn't an
 * unreasonable requirement for development purposes.  The rest of caliper-php works with PHP 5.4.
 */
class TestUtilities {
    private static function formatJson($json) {
        $objects = json_decode($json);
        self::ksortObjectsRecursive($objects);

        return json_encode($objects, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_PRESERVE_ZERO_FRACTION);
    }

    private static function writeJsonFile($jsonFilePath, $formattedJson) {
        if (file_put_contents($jsonFilePath, $formattedJson) === false) {
            throw new PHPUnit_Runner_Exception("Error writing '${$jsonFilePath}'");
        }
    }

    public static function saveFormattedFixtureAndTestJson($fixtureJson, $testJson,
                                                           $filename, $outputDirectoryPath) {
        if ($outputDirectoryPath !== false) {
            self::writeJsonFile($outputDirectoryPath . DIRECTORY_SEPARATOR . $filename . '_output.json',
                self::formatJson($testJson));
            self::writeJsonFile($outputDirectoryPath . DIRECTORY_SEPARATOR . $filename . '_fixture.json',
                self::formatJson($fixtureJson));
        }
    }

    public static function ksortObjectsRecursive(&$data, $sortFlags = SORT_REGULAR) {
        if (!function_exists('ksortObjectsRecursiveCallback')) {
            function ksortObjectsRecursiveCallback(&$data, $unusedKey, $sortFlags) {
                $dataWasCastAsArray = false;
                if (is_object($data)) {
                    $data = (array) $data;
                    $dataWasCastAsArray = true;
                }

                $success = is_array($data) &&
                    ksort($data, $sortFlags) &&
                    array_walk($data, __FUNCTION__, $sortFlags);

                if ($dataWasCastAsArray) {
                    $object = new stdClass();
                    foreach ($data as $key => $value) {
                        $object->$key = $value;
                    }
                    $data = $object;
                }

                return $success;
            }
        }

        return ksortObjectsRecursiveCallback($data, null, $sortFlags);
    }
}