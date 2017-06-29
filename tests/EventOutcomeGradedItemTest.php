<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\assessment\Assessment;
use IMSGlobal\Caliper\entities\assessment\AssessmentItem;
use IMSGlobal\Caliper\entities\assignable\Attempt;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\outcome\Score;
use IMSGlobal\Caliper\events\OutcomeEvent;

/**
 * @requires PHP 5.6.28
 */
class EventOutcomeGradedItemTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();


        $this->setTestObject(
            (new OutcomeEvent('urn:uuid:12c05c4e-253f-4073-9f29-5786f3ff3f36'))
                ->setActor(
                    (new SoftwareApplication('https://example.edu/autograder'))
                        ->setVersion(
                            'v2'
                        )
                )
                ->setAction(
                    new Action(Action::GRADED))
                ->setObject(
                    (new Attempt('https://example.edu/terms/201601/courses/7/sections/1/assess/1/items/3/users/554433/attempts/1'))
                        ->setAssignee(
                            (new Person('https://example.edu/users/554433'))
                        )
                        ->setAssignable(
                            (new AssessmentItem('https://example.edu/terms/201601/courses/7/sections/1/assess/1/items/3'))
                                ->setName(
                                    'Assessment Item 3'
                                )
                                ->setIsPartOf(
                                    (new Assessment('https://example.edu/terms/201601/courses/7/sections/1/assess/1'))
                                )
                        )
                        ->setIsPartOf(
                            new IsPartOfReference('https://example.edu/terms/201601/courses/7/sections/1/assess/1/users/554433/attempts/1'))
                        ->setCount(
                            1
                        )
                        ->setDateCreated(
                            new \DateTime('2016-11-15T10:15:02.000Z'))
                        ->setStartedAtTime(
                            new \DateTime('2016-11-15T10:15:02.000Z'))
                        ->setEndedAtTime(
                            new \DateTime('2016-11-15T10:15:12.000Z'))
                )
                ->setEventTime(
                    new \DateTime('2016-11-15T10:57:06.000Z'))
                ->setEdApp(
                    new EdAppReference('https://example.edu'))
                ->setGenerated(
                    (new Score('https://example.edu/terms/201601/courses/7/sections/1/assess/1/items/3/users/554433/attempts/1/scores/1'))
                        ->setAttempt(
                            new AttemptReference('https://example.edu/terms/201601/courses/7/sections/1/assess/1/users/554433/attempts/1'))
                        ->setMaxScore(
                            5.0
                        )
                        ->setScoreGiven(
                            5.0
                        )
                        ->setScoredBy(
                            new ScoredByReference('https://example.edu/autograder'))
                        ->setComment(
                            'auto-graded exam'
                        )
                        ->setDateCreated(
                            new \DateTime('2016-11-15T10:55:05.000Z'))
                )
                ->setGroup(
                    (new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setCourseNumber(
                            'CPS 435-01'
                        )
                        ->setAcademicSession(
                            'Fall 2016'
                        )
                )
        );
    }
}
