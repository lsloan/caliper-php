<?php
require_once 'Caliper/util/BasicEnum.php';
require_once 'Caliper/util/JsonInclude.php';

class Defaults extends BasicEnum {
    const
        HOST = 'http://example.org/',
        CONNECTION_REQUEST_TIMEOUT = 10000,
        CONNECTION_TIMEOUT = 10000,
        SOCKET_TIMEOUT = 10000,
        JSON_INCLUDE = JsonInclude::ALWAYS,
        JSON_ENCODE_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
        DEBUG = false;
}