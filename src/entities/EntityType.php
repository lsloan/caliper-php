<?php
namespace IMSGlobal\Caliper\entities;

class EntityType extends \IMSGlobal\Caliper\util\BasicEnum implements Type {
    const
        __default = '',
        ANNOTATION = 'http://purl.imsglobal.org/caliper/v1/Annotation',
        ATTEMPT = 'http://purl.imsglobal.org/caliper/v1/Attempt',
        COURSE_OFFERING = 'http://purl.imsglobal.org/caliper/v1/CourseOffering',
        COURSE_SECTION = 'http://purl.imsglobal.org/caliper/v1/CourseSection',
        DIGITAL_RESOURCE = 'http://purl.imsglobal.org/caliper/v1/DigitalResource',
        ENTITY = 'http://purl.imsglobal.org/caliper/v1/Entity',
        GROUP = 'http://purl.imsglobal.org/caliper/v1/Group',
        LEARNING_OBJECTIVE = 'http://purl.imsglobal.org/caliper/v1/LearningObjective',
        MEMBERSHIP = 'http://purl.imsglobal.org/caliper/v1/Membership',
        ORGANIZATION = 'http://purl.imsglobal.org/caliper/v1/Organization',
        PERSON = 'http://purl.imsglobal.org/caliper/v1/Person',
        RESPONSE = 'http://purl.imsglobal.org/caliper/v1/Response',
        RESULT = 'http://purl.imsglobal.org/caliper/v1/Result',
        SESSION = 'http://purl.imsglobal.org/caliper/v1/Session',
        SOFTWARE_APPLICATION = 'http://purl.imsglobal.org/caliper/v1/SoftwareApplication',
        VIEW = 'http://purl.imsglobal.org/caliper/v1/View';
}