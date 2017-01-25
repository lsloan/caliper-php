<?php
use IMSGlobal\Caliper\actions\Action;

require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventOutcomeGradedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\OutcomeEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new Action(Action::GRADED))
            ->setObject(TestAssignableEntities::makeAssessmentAttempt()
                ->setAssignable(TestAssessmentEntities::makeAssessment()))
            ->setGenerated(TestAssignableEntities::makeResult())
            ->setEventTime(TestTimes::startedTime())
            ->setEdApp(TestAgentEntities::makeAssessmentApplication())
            ->setGroup(TestLisEntities::makeGroup())
            ->setMembership(TestLisEntities::makeMembership())
            ->setUuid('a50ca17f-5971-47bb-8fca-4e6e6879001d')
        );
    }
}
