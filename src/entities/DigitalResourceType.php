<?php
namespace IMSGlobal\Caliper\entities;

class DigitalResourceType extends \IMSGlobal\Caliper\util\BasicEnum implements Type {
    const
        __default = '',
        ASSIGNABLE_DIGITAL_RESOURCE = 'AssignableDigitalResource',
        CHAPTER = 'Chapter',
        DOCUMENT = 'Document',
        EPUB_CHAPTER = 'EpubChapter',
        EPUB_PART = 'EpubPart',
        EPUB_VOLUME = 'EpubVolume',
        FRAME = 'Frame',
        MEDIA_OBJECT = 'MediaObject',
        MEDIA_LOCATION = 'MediaLocation',
        READING = 'Reading',
        WEB_PAGE = 'WebPage';
}