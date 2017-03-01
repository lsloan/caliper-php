<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\annotation\SharedAnnotation;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\AnnotationEvent;


/**
 * @requires PHP 5.6.28
 */
class EventAnnotationSharedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new AnnotationEvent())
            ->setActor(new Person('https://example.edu/users/554433'))
            ->setAction(new Action(Action::SHARED))
            ->setObject((new Document('https://example.edu/etexts/201.epub'))
                ->setName('IMS Caliper Implementation Guide')
                ->setVersion('1.1')
            )
            ->setGenerated((new SharedAnnotation('https://example.edu/users/554433/etexts/201/shares/1'))
                ->setAnnotator(new Person('https://example.edu/users/554433'))
                ->setAnnotated(new Document('https://example.edu/etexts/201.epub'))
                ->setWithAgents([
                    (new Person('https://example.edu/users/657585')),
                    (new Person('https://example.edu/users/667788')),
                ])
                ->setDateCreated(new \DateTime('2016-11-15T10:15:00.000Z')))
            ->setEventTime(new \DateTime('2016-11-15T10:15:00.000Z'))
            ->setEdApp((new SoftwareApplication('https://example.edu'))
                ->setVersion('1.2.3')
            )
            ->setGroup((new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                ->setCourseNumber('CPS 435-01')
                ->setAcademicSession('Fall 2016')
            )
            ->setMembership((new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                ->setMember(new Person('https://example.edu/users/554433'))
                ->setOrganization(new CourseSection('https://example.edu/terms/201601/courses/7/sections/1'))
                ->setRoles([new Role(Role::LEARNER)])
                ->setStatus(new Status(Status::ACTIVE))
                ->setDateCreated(new \DateTime('2016-08-01T06:00:00.000Z')))
            ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
            ->setUuid('3bdab9e6-11cd-4a0f-9d09-8e363994176b')
        );
    }
}
