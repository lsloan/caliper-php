<?php
abstract class BasicEnum implements JsonSerializable {
    const DEFAULT_KEY = '__default';
    private static $constCacheArray = NULL;
    private $value;

    public function __construct($value = null) {
        $errorMessage = null;

        if (is_null($value)) {
            $constants = @self::getConstants();
            if (array_key_exists(self::DEFAULT_KEY, $constants)) {
                $value = $constants[self::DEFAULT_KEY];
            } else {
                $errorMessage = 'No "' . self::DEFAULT_KEY . '" value.';
            }
        } elseif (!self::isValidValue($value)) {
            $errorMessage = 'Invalid value.';
        }

        if (!is_null($errorMessage)) {
            throw new InvalidArgumentException(get_called_class() . '::' . __FUNCTION__ .
                ': ' . $errorMessage . ' Valid values: ' .
                join(', ', array_keys(self::getConstants())));
        }

        $this->value = $value;
    }

    function jsonSerialize() {
        return $this->getValue();
    }

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

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }
}