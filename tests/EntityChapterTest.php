<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\reading\Chapter;
use IMSGlobal\Caliper\entities\reading\Document;


/**
 * @requires PHP 5.4
 */
class EntityChapterTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new Chapter('https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!)'))
                ->setName(
                    'The Caliper Information Model'
                )
                ->setIsPartOf(
                    (new Document('https://example.edu/etexts/201.epub'))
                        ->setDateCreated(
                            new \DateTime('2016-10-01T06:00:00.000Z'))
                        ->setName(
                            'IMS Caliper Implementation Guide'
                        )
                        ->setVersion(
                            '1.1'
                        )
                )
        );
    }
}
