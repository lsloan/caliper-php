<?php
use IMSGlobal\Caliper\entities\annotation;

class TestAnnotationEntities {
    /** @return annotation\BookmarkAnnotation */
    public static function makeBookmarkAnnotation() {
        return (new annotation\BookmarkAnnotation('https://example.edu/users/554433/etexts/201/bookmarks/1'))
            ->setDateCreated(TestTimes::createdTime2())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame2())
            ->setBookmarkNotes('Caliper profiles model discrete learning activities or supporting activities that enable learning.');
    }

    /** @return annotation\HighlightAnnotation */
    public static function makeHighlightAnnotation() {
        return (new annotation\HighlightAnnotation('https://example.edu/users/554433/etexts/201/highlights?start=2300&end=2370'))
            // TODO: Add `Annotation.actor` property #200
            //->setActor(TestAgentEntities::makePerson())
            ->setDateCreated(TestTimes::createdTime2())
            // XXX: Removed for EventAnnotationHighlightedTest.php
            //->setDateModified(TestTimes::modifiedTime())
            // TODO: Add `Document` entity #202
            // TODO: (annotated should be a Document object, not a reference)
            ->setAnnotated(TestReadingEntities::makeDocument())
            // TODO: `TextPositionSelector`: `start` and `end` types; extend `Entity` #201
            ->setSelection((new annotation\TextPositionSelector())
                ->setStart('2300') // TODO: `TextPositionSelector`: `start` and `end` types; extend `Entity` #201
                ->setEnd('2370')) // TODO: `TextPositionSelector`: `start` and `end` types; extend `Entity` #201
            ->setSelectionText('ISO 8601 formatted date and time expressed with millisecond precision.');
    }

    /** @return annotation\SharedAnnotation */
    public static function makeSharedAnnotation() {
        return (new annotation\SharedAnnotation('https://example.edu/shared/9999'))
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame3())
            ->setWithAgents(TestAgentEntities::makeWithAgents());
    }

    /** @return annotation\TagAnnotation */
    public static function makeTagAnnotation() {
        return (new annotation\TagAnnotation('https://example.edu/tags/7654'))
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setAnnotated(TestReadingEntities::makeFrame4())
            ->setTags(["to-read", "1765", "shared-with-project-team"]);
    }
}