<?php

class JsonUtil {
    /**
     * Return function for use with array_filter() to keep only nonempty structures and nonnull values.
     *
     * This method returns a function so that it's not necessary to specify the filter function to
     * array_filter() by using its name in a string.
     *
     * Unfortunately, PHP's default JSON support isn't sophisticated enough to provide an option that
     * accomplishes what this filter does.  Each implementation of jsonSerialize() in each class must use
     * this filter.  It would be best for this filter to be used from only a small number (preferably one)
     * of high level classes, but due to peculiarities of PHP's object model, such a solution hasn't been
     * found yet.  Another alternative would be to switch to a different JSON library or create one.
     *
     * @return callable
     */
    public static function keepOnlyNonemptyNonnull() {
        return function ($value) {
            if (is_object($value) || is_array($value)) {
                return !empty((array) $value);
            } else {
                return !is_null($value);
            }
        };
    }
}