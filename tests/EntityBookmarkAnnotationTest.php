<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\annotation\BookmarkAnnotation;
use IMSGlobal\Caliper\entities\reading\Chapter;


/**
 * @requires PHP 5.4
 */
class EntityBookmarkAnnotationTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new BookmarkAnnotation('https://example.edu/users/554433/etexts/201/bookmarks/1'))
                ->setAnnotator(
                    (new Person('https://example.edu/users/554433'))
                )
                ->setAnnotated(
                    (new Chapter('https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!/4[body01]/10[para05]/1:20)'))
                )
                ->setBookmarkNotes(
                    'Caliper profiles model discrete learning activities or supporting activities that facilitate learning.'
                )
                ->setDateCreated(
                    new \DateTime('2016-08-01T06:00:00.000Z'))
        );
    }
}
