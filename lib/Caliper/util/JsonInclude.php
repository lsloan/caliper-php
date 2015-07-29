<?php
require_once 'Caliper/util/BasicEnum.php';

/**
 * Class JsonInclude
 *
 * See: http://fasterxml.github.io/jackson-annotations/javadoc/2.0.5/com/fasterxml/jackson/annotation/JsonInclude.Include.html
 */
class JsonInclude extends BasicEnum {
    const
        __default = '',
        ALWAYS = 'ALWAYS',
        NON_DEFAULT = 'NON_DEFAULT', // Not implemented
        NON_EMPTY = 'NON_EMPTY',
        NON_NULL = 'NON_NULL';
}