<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\annotation\TagAnnotation;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\Chapter;
use IMSGlobal\Caliper\entities\reading\Document;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\AnnotationEvent;


/**
 * @requires PHP 5.6.28
 */
class EventAnnotationTaggedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new AnnotationEvent())
            ->setActor(new Person('https://example.edu/users/554433'))
            ->setAction(new Action(Action::TAGGED))
            ->setObject((new Document('https://example.edu/etexts/201.epub'))
                ->setName('IMS Caliper Implementation Guide')
                ->setVersion('1.1')
            )
            ->setGenerated((new TagAnnotation('https://example.edu/users/554433/etexts/201/tags/3'))
                ->setAnnotator(new Person('https://example.edu/users/554433'))
                ->setAnnotated(new Chapter('https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!/4[body01]/12[para06]/1:97)'))
                ->setTags([
                    'profile',
                    'event',
                    'entity',
                ])
                ->setDateCreated(new \DateTime('2016-11-15T10:15:00.000Z')))
            ->setEventTime(new \DateTime('2016-11-15T10:15:00.000Z'))
            ->setEdApp((new SoftwareApplication('https://example.edu'))
                ->setVersion('v2')
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
            ->setUuid('b2009c63-2659-4cd2-b71e-6e03c498f02b')
        );
    }
}
