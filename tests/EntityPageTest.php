<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\Page;
use IMSGlobal\Caliper\entities\reading\Chapter;
use IMSGlobal\Caliper\entities\reading\Document;


/**
 * @requires PHP 5.4
 */
class EntityPageTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new Page('https://example.edu/etexts/201/chs/2/pp/23'))
            ->setName('Page 23')
            ->setIsPartOf((new Chapter('https://example.edu/etexts/201/chs/2'))
                ->setName('Chapter 2')
                ->setIsPartOf((new Document('https://example.edu/etexts/201'))
                    ->setName('IMS Caliper Implementation Guide')
                    ->setDateCreated(new \DateTime('2016-10-01T06:00:00.000Z'))
                    ->setVersion('1.1')
                )
            )
        );
    }
}
