<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\annotation\TagAnnotation;
use IMSGlobal\Caliper\entities\reading\Chapter;


/**
 * @requires PHP 5.4
 */
class EntityTagAnnotationTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new TagAnnotation('https://example.edu/users/554433/etexts/201/tags/3'))
                ->setAnnotator(
                    (new Person('https://example.edu/users/554433'))
                )
                ->setAnnotated(
                    (new Chapter('https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!/4[body01]/12[para06]/1:97)'))
                )
                ->setTags(
                    [
                        'profile'
                        ,
                        'event'
                        ,
                        'entity'
                        ,
                    ]
                )
                ->setDateCreated(
                    new \DateTime('2016-08-01T09:00:00.000Z'))
        );
    }
}
