<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\ViewEvent;


/**
 * @requires PHP 5.4
 */
class EventViewViewedExtendedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new ViewEvent())
                ->setActor(
                    (new Person('https://example.edu/users/554433'))
                )
                ->setAction(
                    new Action(Action::VIEWED))
                ->setObject(
                    (new Document('https://example.edu/etexts/200.epub'))
                        ->setName(
                            'IMS Caliper Specification'
                        )
                        ->setVersion(
                            '1.1'
                        )
                )
                ->setEventTime(
                    new \DateTime('2016-11-15T10:15:00.000Z'))
                ->setEdApp(
                    (new SoftwareApplication('https://example.edu'))
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
                ->setMembership(
                    (new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                        ->setMember(
                            (new Person('https://example.edu/users/554433'))
                        )
                        ->setOrganization(
                            (new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                        )
                        ->setRoles(
                            [new Role(Role::LEARNER)])
                        ->setStatus(
                            new Status(Status::ACTIVE))
                        ->setDateCreated(
                            new \DateTime('2016-08-01T06:00:00.000Z'))
                )
                ->setSession(
                    (new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                        ->setStartedAtTime(
                            new \DateTime('2016-11-15T10:00:00.000Z'))
                )
                ->setUuid(
                    '3a9bd869-addc-48b1-80f6-a14b2ff591ed'
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
                                        'ChronJob' => 'example:ChronJob',
                                        'job' => 'example:job',
                                        'jobTag' =>
                                            (array(
                                                'id' => 'example:jobTag',
                                                'type' => 'xsd:string',
                                            )),
                                        'jobDate' =>
                                            (array(
                                                'id' => 'example:jobDate',
                                                'type' => 'xsd:dateTime',
                                            )),
                                    )),
                                'job' =>
                                    (array(
                                        'id' => 'https://example.edu/data/jobs/08c1233d-9ba3-40ac-952f-004c47a50ff7',
                                        'type' => 'ChronJob',
                                        'jobTag' => 'caliper',
                                        'jobDate' => '2016-11-16T01:01:00.000Z',
                                    )),
                            )),
                    ))
        );
    }
}
