<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventMediaPausedVideoTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\MediaEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setMembership(TestLisEntities::makeMembership())
            ->setAction(new IMSGlobal\Caliper\actions\Action(IMSGlobal\Caliper\actions\Action::PAUSED))
            ->setObject(TestMediaEntities::makeVideoObject())
            ->setTarget(TestMediaEntities::makeMediaLocation())
            ->setEdApp(TestAgentEntities::makeMediaApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setEventTime(TestTimes::startedTime()));
    }
}
