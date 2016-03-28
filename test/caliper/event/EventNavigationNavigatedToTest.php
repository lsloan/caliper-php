<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/NavigationEvent.php';

/**
 * @requires PHP 5.4
 */
class EventNavigationNavigatedToTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new NavigationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setObject(TestReadingEntities::makeEPubVolume())
            ->setNavigatedFrom(TestReadingEntities::makeWebPage())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setTarget(TestReadingEntities::makeFrame1())
            ->setGroup(TestLisEntities::makeGroup())
            ->setEventTime(TestTimes::startedTime()));
    }
}
