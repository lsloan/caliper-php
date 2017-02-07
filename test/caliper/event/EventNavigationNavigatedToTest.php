<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventNavigationNavigatedToTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\NavigationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setObject(TestReadingEntities::makeEPubVolume())
            //->setNavigatedFrom(TestReadingEntities::makeWebPage())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setTarget(TestReadingEntities::makeDocument())
            ->setGroup(TestLisEntities::makeGroup())
            ->setEventTime(TestTimes::startedTime())
            ->setUuid('ff9ec22a-fc59-4ae1-ae8d-2c9463ee2f8f')
        );
    }
}
