<?php
namespace IMSGlobal\Caliper\entities\assignable;

use IMSGlobal\Caliper;

class AssignableDigitalResourceType extends Caliper\util\BasicEnum implements Caliper\entities\Type {
    const
        __default = '',
        ASSESSMENT = 'http://purl.imsglobal.org/caliper/v1/Assessment',
        ASSESSMENT_ITEM = 'http://purl.imsglobal.org/caliper/v1/AssessmentItem';
}