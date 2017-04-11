<?php
use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\context\Context;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\ViewEvent;
use IMSGlobal\Caliper\request\Envelope;
use IMSGlobal\Caliper\Sensor;

require_once 'CaliperTestCase.php';

class TestContext extends Context {
    const
        __default = null,
        NULL = null,
        EVENT = [
        'http://purl.imsglobal.org/ctx/caliper/v1p1',
        [
            'actor' => [
                'id' => 'Person',
                'type' => 'id',
            ],
        ],
        [
            'edApp' => [
                'id' => 'SoftwareApplication',
                'type' => 'id',
            ],
        ],
        [
            'object' => [
                'id' => 'Document',
                'type' => 'id',
            ],
        ],
    ],
        MEMBERSHIP = [
        [
            'member' => [
                'id' => 'Person',
                'type' => 'id',
            ],
        ],
    ];
}

/**
 * @requires PHP 5.6.28
 */
class EnvelopeEventViewViewedCoercedTest extends CaliperTestCase {


    function setUp() {
        parent::setUp();

        $this->setTestObject((new Envelope())
            ->setSensorId(new Sensor('https://example.edu/sensors/1'))
            ->setSendTime(new \DateTime('2016-11-15T11:05:01.000Z'))
            ->setData([
                (new ViewEvent())
                    ->setContext(new TestContext(TestContext::EVENT))
                    ->setActor(new Person('https://example.edu/users/554433'))
                    ->setAction(new Action(Action::VIEWED))
                    ->setObject((new Document('https://example.edu/etexts/201.epub'))
                        ->setName('IMS Caliper Implementation Guide')
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z'))
                        ->setDatePublished(new \DateTime('2016-10-01T06:00:00.000Z'))
                        ->setVersion('1.1')
                    )
                    ->setEventTime(new \DateTime('2016-11-15T10:15:00.000Z'))
                    ->setEdApp(new SoftwareApplication('https://example.edu'))
                    ->setGroup((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        ->setContext(new TestContext(TestContext::NULL))
                        ->setCourseNumber('CPS 435-01')
                        ->setAcademicSession('Fall 2016')
                    )
                    ->setMembership((new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                        ->setContext(new TestContext(TestContext::MEMBERSHIP))
                        ->setMember(new Person('https://example.edu/users/554433'))
                        ->setOrganization((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                            ->setContext(new TestContext(TestContext::NULL)))
                        ->setRoles([new Role(Role::LEARNER)])
                        ->setStatus(new Status(Status::ACTIVE))
                        ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z')))
                    ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                        ->setContext(new TestContext(TestContext::NULL))
                        ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
                    ->setId('urn:uuid:e6f54458-19e3-47e3-bc18-43f231c74a45'),
            ])
        );
    }
}
