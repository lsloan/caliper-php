<?php
use IMSGlobal\Caliper\entities\annotation;

class TestAnnotationEntities {
    /** @return annotation\BookmarkAnnotation */
    public static function makeBookmarkAnnotation() {
        return (new annotation\BookmarkAnnotation('https://example.edu/bookmarks/00001'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame2())
            ->setBookmarkNotes('The Intolerable Acts (1774)--bad idea Lord North');
    }

    /** @return annotation\HighlightAnnotation */
    public static function makeHighlightAnnotation() {
        return (new annotation\HighlightAnnotation('https://example.edu/highlights/12345'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame1())
            ->setSelection((new annotation\TextPositionSelector())
                ->setStart('455')
                ->setEnd('489'))
            ->setSelectionText('Life, Liberty and the pursuit of Happiness');
    }

    /** @return annotation\SharedAnnotation */
    public static function makeSharedAnnotation() {
        return (new annotation\SharedAnnotation('https://example.edu/shared/9999'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame3())
            ->setWithAgents(TestAgentEntities::makeWithAgents());
    }

    /** @return annotation\TagAnnotation */
    public static function makeTagAnnotation() {
        return (new annotation\TagAnnotation('https://example.edu/tags/7654'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame4())
            ->setTags(["to-read", "1765", "shared-with-project-team"]);
    }
}