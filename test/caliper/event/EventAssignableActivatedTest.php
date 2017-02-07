<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventAssignableActivatedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\AssignableEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new IMSGlobal\Caliper\actions\Action(IMSGlobal\Caliper\actions\Action::ACTIVATED))
            ->setObject(TestAssessmentEntities::makeAssessment())
            ->setGenerated(TestAssignableEntities::makeAssessmentAttempt()
                ->setAssignable(TestAssessmentEntities::makeAssessment()))
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership())
            ->setUuid('2635b9dd-0061-4059-ac61-2718ab366f75')
        );
    }
}
