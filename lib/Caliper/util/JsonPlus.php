<?php

/**
 * Class JsonPlus
 */
class JsonPlus {
    /**
     * A wrapper for json_encode() with the ability to run a filter on the data first.
     *
     * @param mixed $value
     * @param mixed $options A json_encode() option, a callable filter function for
     *      use with array_filter(), or an array of both
     * @param int $depth
     * @return string a JSON encoded string on success or <b>FALSE</b> on failure.
     */
    public static function jsonEncode($value, $options = null, $depth = 512) {
        $jsonOptions = 0;
        $filter = null;

        $options = (is_array($options)) ? array_slice($options, 0, 2) : [$options];

        foreach ($options as $option) {
            if (is_int($option)) {
                $jsonOptions = $option;
            } elseif (is_callable($option)) {
                $filter = $option;
            }
        }

        if ($filter !== null) {
            $value = self::preencode($value, $filter);
        }

        return json_encode($value, $jsonOptions, $depth);
    }

    /**
     * PHP's json_encode() shamefully lacks the ability to filter out certain values
     * (e.g. empty structures and null values) from the JSON it produces.  This solution is
     * a recursive method, which calls jsonSerialize() on every object that implements the
     * JsonSerializable interface, as json_encode() would, then use an array filter to
     * remove undesired values.
     *
     * @param mixed $value
     * @param mixed $filter Callable function for use with array_filter() or null
     * @return array|mixed
     */
    public static function preencode($value, $filter) {
        if (!is_null($filter)) {
            if ($value instanceof JsonSerializable) {
                $value = $value->jsonSerialize();
            }

            if (is_array($value)) {
                $value = array_filter($value, $filter);

                foreach ($value as $propertyKey => $propertyValue) {
                    $value[$propertyKey] = self::preencode($propertyValue, $filter);
                }
            }
        }

        return $value;
    }

    /*
     * The filter methods below return functions so it's not necessary to reference
     * their names as strings when used with array_filter().
     */

    /**
     * Return function for use with array_filter() to keep only nonempty structures
     * and nonnull values.
     *
     * @return callable
     */
    public static function isNonemptyNonnull() {
        return function ($value) {
            if (is_object($value) || is_array($value)) {
                return !empty((array) $value);
            } else {
                return !is_null($value);
            }
        };
    }

    /**
     * Return function for use with array_filter() to keep only nonnull values.
     *
     * @return callable
     */
    public static function isNonnull() {
        return function ($value) {
            return !is_null($value);
        };
    }
}