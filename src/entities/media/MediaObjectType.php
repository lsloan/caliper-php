<?php
namespace IMSGlobal\Caliper\entities\media;

use IMSGlobal\Caliper;

class MediaObjectType extends Caliper\util\BasicEnum implements Caliper\entities\Type {
    const
        __default = '',
        AUDIO_OBJECT = 'http://purl.imsglobal.org/caliper/v1/AudioObject',
        IMAGE_OBJECT = 'http://purl.imsglobal.org/caliper/v1/ImageObject',
        VIDEO_OBJECT = 'http://purl.imsglobal.org/caliper/v1/VideoObject';
}
