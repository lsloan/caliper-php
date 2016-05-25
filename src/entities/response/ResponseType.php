<?php
namespace IMSGlobal\Caliper\entities\response;

use IMSGlobal\Caliper;

class ResponseType extends Caliper\util\BasicEnum implements Caliper\entities\Type {
    const
        FILLINBLANK = 'http://purl.imsglobal.org/caliper/v1/FillinBlankResponse',
        MULTIPLECHOICE = 'http://purl.imsglobal.org/caliper/v1/MultipleChoiceResponse',
        MULTIPLERESPONSE = 'http://purl.imsglobal.org/caliper/v1/MultipleResponseResponse',
        SELECTTEXT = 'http://purl.imsglobal.org/caliper/v1/SelectTextResponse',
        TRUEFALSE = 'http://purl.imsglobal.org/caliper/v1/TrueFalseResponse';
}