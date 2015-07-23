<?php
foreach (getallheaders() as $name => $value) {
    error_log("${name}: ${value}");
}

$rawPostData = file_get_contents('php://input');
error_log("Raw post data:\n${rawPostData}");
error_log('Received ' . strlen($rawPostData) . ' bytes');