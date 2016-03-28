<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');
require_once 'Caliper/events/AssignableEvent.php';
require_once 'Caliper/actions/Action.php';

/**
 * @requires PHP 5.4
 */
class EventAssignableActivatedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new AssignableEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::ACTIVATED))
            ->setObject(TestAssessmentEntities::makeAssessment())
            ->setGenerated(TestAssignableEntities::makeAssessmentAttempt()
                ->setAssignable(TestAssessmentEntities::makeAssessment()))
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership()));
    }
}
