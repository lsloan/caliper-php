<?php
namespace IMSGlobal\Caliper\util;

class TypeUtil {
    /**
     * Given an array, return true if all of its keys are strings, return false otherwise.
     * @param array $array
     * @return bool formatted timestamp
     */
    static function isStringKeyedArray(array $array) {
        if ([] === $array) return false;
        return count(array_filter(array_keys($array), 'is_integer')) == 0;
    }
}