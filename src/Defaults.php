<?php
namespace IMSGlobal\Caliper;

class Defaults extends util\BasicEnum {
    const
        HOST = 'http://example.org/',
        CONNECTION_REQUEST_TIMEOUT = 10000,
        CONNECTION_TIMEOUT = 10000,
        SOCKET_TIMEOUT = 10000,
        JSON_INCLUDE = util\JsonInclude::NON_EMPTY,
        JSON_ENCODE_OPTIONS = 192, // = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES, // (required new const syntax of PHP 5.6)
        DEBUG = false;
}
