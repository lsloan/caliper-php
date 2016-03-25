<?php

/**
 * Class BasicEnum
 *
 * A pure-PHP alternative to SplEnum, although not a 100% compatible replacement for it.
 *
 * See: http://php.net/manual/en/class.splenum.php
 *
 * To declare an enum class, subclass BasicEnum and define the names and values as constants.
 * If the enum is to allow instantiation with a null value, it needs to have a default value
 * defined in the constant "__default".
 */
abstract class BasicEnum implements JsonSerializable {
    const __BASICENUM_DEFAULT_KEY = '__default';
    private static $constCacheArray = NULL;
    private $value;

    public function __construct($value = null) {
        $errorMessage = null;

        if (is_null($value)) {
            $constants = @self::getConstants();
            if (array_key_exists(self::__BASICENUM_DEFAULT_KEY, $constants)) {
                $value = $constants[self::__BASICENUM_DEFAULT_KEY];
            } else {
                $errorMessage = 'No "' . self::__BASICENUM_DEFAULT_KEY . '" value.';
            }
        } elseif (!self::isValidValue($value)) {
            $errorMessage = 'Invalid value.';
        }

        if (!is_null($errorMessage)) {
            throw new InvalidArgumentException(get_called_class() . '::' . __FUNCTION__ .
                ': ' . $errorMessage . ' Valid values: ' .
                join(', ', array_filter(array_keys(self::getConstants()), function($v){
                    return strpos($v, '__') !== 0;
                })));
        }

        $this->value = $value;
    }

    function jsonSerialize() {
        return $this->getValue();
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @return array
     */
    private static function getConstants() {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param $name
     * @param bool $strict Case is significant when searching for name
     * @return bool
     */
    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }
}