<?php
use IMSGlobal\Caliper\entities\media;

class TestMediaEntities {
    /** @return string */
    public static function videoId() {
        return 'https://example.com/super-media-tool/video/1225';
    }

    /** @return media\MediaLocation */
    public static function makeMediaLocation() {
        return (new media\MediaLocation(self::videoId()))
            ->setDateCreated(TestTimes::createdTime())
            ->setCurrentTime(710)
            ->setVersion('1.0');
    }

    /** @return media\VideoObject */
    public static function makeVideoObject() {
        return (new media\VideoObject(self::videoId()))
            ->setName('American Revolution - Key Figures Video')
            ->setLearningObjectives(TestEntities::makeLearningObjective())
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setDuration(1420)
            ->setVersion('1.0');
    }
}