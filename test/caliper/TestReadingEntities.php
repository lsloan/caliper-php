<?php
use IMSGlobal\Caliper\entities\reading;
use IMSGlobal\Caliper\entities\reading\Frame;

class TestReadingEntities {
    /** @return reading\EPubVolume */
    public static function makeEPubVolume() {
        return (new reading\EPubVolume('https://example.com/viewer/book/34843#epubcfi(/4/3)'))
            ->setName('The Glorious Cause: The American Revolution, 1763-1789 (Oxford History of the United States)')
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setVersion('2nd ed.');
    }

    /** @return Frame */
    public static function makeFrame1() {
        // TODO: Replace Frame with Document object
        // TODO: Add `Document` entity #202
        return (new Frame('https://example.edu/etexts/201'))
            ->setName('IMS Caliper Implementation Guide')
            ->setDateCreated(new \DateTime('2016-10-01T06:00:00.000Z'))
            // XXX: Removed for EventAnnotationHighlightedTest.php
            //->setDateModified(TestTimes::modifiedTime())
            //->setIsPartOf(self::makeEPubVolume())
            ->setVersion('1.1');
    }

    /** @return Frame */
    public static function makeFrame2() {
        return (new Frame('https://example.edu/etexts/201.epub'))
            ->setName('IMS Caliper Implementation Guide')
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setIsPartOf(self::makeEPubVolume())
            ->setVersion('1.1')
            ->setIndex(2);
    }

    /** @return Frame */
    public static function makeFrame3() {
        return (new Frame('https://example.com/viewer/book/34843#epubcfi(/4/3/3)'))
            ->setName('Key Figures: John Adams')
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setIsPartOf(self::makeEPubVolume())
            ->setVersion('2nd ed.')
            ->setIndex(3);
    }

    /** @return Frame */
    public static function makeFrame4() {
        return (new Frame('https://example.com/viewer/book/34843#epubcfi(/4/3/4)'))
            ->setName('The Stamp Act Crisis')
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setIsPartOf(self::makeEPubVolume())
            ->setVersion('2nd ed.')
            ->setIndex(4);
    }

    /** @return reading\WebPage */
    public static function makeWebPage() {
        return (new reading\WebPage('https://example.edu/politicalScience/2015/american-revolution-101/index.html'))
            ->setName('American Revolution 101 Landing Page')
            ->setDateCreated(TestTimes::createdTime1())
            ->setDateModified(TestTimes::modifiedTime())
            ->setVersion('1.0');
    }
}