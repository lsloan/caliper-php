<?php
require_once realpath(dirname(__FILE__) . '/../CaliperTestCase.php');

/**
 * @requires PHP 5.4
 */
class EventAnnotationHighlightedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new IMSGlobal\Caliper\events\AnnotationEvent())
            ->setActor(TestAgentEntities::makePerson())
            ->setAction(new IMSGlobal\Caliper\actions\Action(IMSGlobal\Caliper\actions\Action::HIGHLIGHTED))
            ->setObject(TestReadingEntities::makeFrame1())
            ->setGenerated(TestAnnotationEntities::makeHighlightAnnotation())
            ->setEventTime(TestTimes::eventTime())
            ->setEdApp(TestAgentEntities::makeReadingApplication())
            ->setGroup(TestLisEntities::makeCourseSection())
            ->setMembership(TestLisEntities::makeMembership())
            ->setUuid('0067a052-9bb4-4b49-9d1a-87cd43da488a')
        );
    }
}
