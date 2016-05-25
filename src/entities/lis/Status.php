<?php
namespace IMSGlobal\Caliper\entities\lis;

use IMSGlobal\Caliper;

class Status extends Caliper\util\BasicEnum implements Caliper\entities\w3c\Status {
    const
        __default = '',
        ACTIVE = 'http://purl.imsglobal.org/vocab/lis/v2/status#Active',
        DELETED = 'http://purl.imsglobal.org/vocab/lis/v2/status#Deleted',
        INACTIVE = 'http://purl.imsglobal.org/vocab/lis/v2/status#Inactive';
}
