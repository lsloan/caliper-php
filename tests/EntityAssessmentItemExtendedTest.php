<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\assessment\Assessment;
use IMSGlobal\Caliper\entities\assessment\AssessmentItem;


/**
 * @requires PHP 5.4
 */
class EntityAssessmentItemExtendedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new AssessmentItem('https://example.edu/terms/201601/courses/7/sections/1/assess/1/items/3'))
                ->setIsPartOf(
                    (new Assessment('https://example.edu/terms/201601/courses/7/sections/1/assess/1'))
                )
                ->setDateCreated(
                    new \DateTime('2016-08-01T06:00:00.000Z'))
                ->setDatePublished(
                    new \DateTime('2016-08-15T09:30:00.000Z'))
                ->setIsTimeDependent(
                    false
                )
                ->setMaxAttempts(
                    2
                )
                ->setMaxScore(
                    5.0
                )
                ->setMaxSubmits(
                    2
                )
                ->setExtensions(
                    array(
                        0 =>
                            (array(
                                '@context' =>
                                    (array(
                                        'id' => '@id',
                                        'type' => '@type',
                                        'example' => 'http://example.edu/ctx/edu',
                                        'xsd' => 'http://www.w3.org/2001/XMLSchema#',
                                        'itemType' =>
                                            (array(
                                                'id' => 'example:itemType',
                                                'type' => 'xsd:string',
                                            )),
                                        'itemText' =>
                                            (array(
                                                'id' => 'example:itemText',
                                                'type' => 'xsd:string',
                                            )),
                                        'itemCorrectResponse' =>
                                            (array(
                                                'id' => 'example:itemCorrectResponse',
                                                'type' => 'xsd:boolean',
                                            )),
                                    )),
                                'itemType' => 'true/false',
                                'itemText' => 'In Caliper event actors are limited to people only.',
                                'itemCorrectResponse' => false,
                            )),
                    ))
        );
    }
}
