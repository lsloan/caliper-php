<?php
use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\reading\WebPage;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\NavigationEvent;
use IMSGlobal\Caliper\Sensor;

require_once 'CaliperTestCase.php';


/**
 * @requires PHP 5.4
 */
class EnvelopeEventBatchTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (new \IMSGlobal\Caliper\request\Envelope())
                ->setSendTime(new \DateTime('2016-11-15T11:05:01.000Z'))
                ->setSensorId(new Sensor('https://example.edu/sensors/1'))
                ->setDataVersion('http://purl.imsglobal.org/ctx/caliper/v1p1')
                ->setData([
                        (new NavigationEvent())
                            ->setActor(
                                (new Person('https://example.edu/users/554433'))
                            )
                            ->setAction(
                                new Action(Action::NAVIGATED_TO))
                            ->setObject(
                                (new WebPage('https://example.edu/terms/201601/courses/7/sections/1/pages/2'))
                                    ->setName(
                                        'Learning Analytics Specifications'
                                    )
                                    ->setDescription(
                                        'Overview of Learning Analytics Specifications with particular emphasis on IMS Caliper.'
                                    )
                                    ->setDateCreated(
                                        new \DateTime('2016-08-01T09:00:00.000Z'))
                            )
                            ->setEventTime(
                                new \DateTime('2016-11-15T10:15:00.000Z'))
                            ->setReferrer(
                                (new WebPage('https://example.edu/terms/201601/courses/7/sections/1/pages/1'))
                            )
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
                                '72f66ce5-d2ec-44cc-bce5-41602e1015dc'
                            ),
                    ]
                )
        );
    }
}

// ([
//     '@context' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
//     'type' => 'AnnotationEvent',
//     'assignee' =>
//         ([
//             'id' => 'https://example.edu/users/554433',
//             'type' => 'Person',
//         ]),
//     'action' => 'Bookmarked',
//     'object' =>
//         ([
//             'id' => 'https://example.edu/etexts/201.epub',
//             'type' => 'Document',
//             'name' => 'IMS Caliper Implementation Guide',
//             'version' => '1.1',
//         ]),
//     'generated' =>
//         ([
//             'id' => 'https://example.edu/users/554433/etexts/201/bookmarks/1',
//             'type' => 'BookmarkAnnotation',
//             'assignee' =>
//                 ([
//                     'id' => 'https://example.edu/users/554433',
//                     'type' => 'Person',
//                 ]),
//             'annotated' =>
//                 ([
//                     'id' => 'https://example.edu/etexts/201.epub#epubcfi(/6/4[chap01]!/4[body01]/10[para05]/1:20)',
//                     'type' => 'Chapter',
//                 ]),
//             'bookmarkNotes' => 'Caliper profiles model discrete learning activities or supporting activities that enable learning.',
//             'dateCreated' => '2016-11-15T10:20:00.000Z',
//         ]),
//     'eventTime' => '2016-11-15T10:20:00.000Z',
//     'edApp' =>
//         ([
//             'id' => 'https://example.edu',
//             'type' => 'SoftwareApplication',
//             'name' => 'ePub Reader',
//             'version' => '1.2.3',
//         ]),
//     'group' =>
//         ([
//             'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
//             'type' => 'CourseSection',
//             'courseNumber' => 'CPS 435-01',
//             'academicSession' => 'Fall 2016',
//         ]),
//     'membership' =>
//         ([
//             'id' => 'https://example.edu/terms/201601/courses/7/sections/1/rosters/1',
//             'type' => 'Membership',
//             'member' =>
//                 ([
//                     'id' => 'https://example.edu/users/554433',
//                     'type' => 'Person',
//                 ]),
//             'organization' =>
//                 ([
//                     'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
//                     'type' => 'CourseSection',
//                 ]),
//             'roles' =>
//                 [
//                     0 => 'Learner',
//                 ],
//             'status' => 'Active',
//             'dateCreated' => '2016-08-01T06:00:00.000Z',
//         ]),
//     'session' =>
//         ([
//             'id' => 'https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259',
//             'type' => 'Session',
//             'startedAtTime' => '2016-11-15T10:00:00.000Z',
//         ]),
//     'uuid' => 'c0afa013-64df-453f-b0a6-50f3efbe4cc0',
// ]),
//                         ([
//                             '@context' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
//                             'type' => 'ViewEvent',
//                             'assignee' =>
//                                 ([
//                                     'id' => 'https://example.edu/users/554433',
//                                     'type' => 'Person',
//                                 ]),
//                             'action' => 'Viewed',
//                             'object' =>
//                                 ([
//                                     'id' => 'https://example.edu/etexts/201.epub',
//                                     'type' => 'Document',
//                                     'name' => 'IMS Caliper Implementation Guide',
//                                     'dateCreated' => '2016-08-01T06:00:00.000Z',
//                                     'datePublished' => '2016-10-01T06:00:00.000Z',
//                                     'version' => '1.1',
//                                 ]),
//                             'eventTime' => '2016-11-15T10:21:00.000Z',
//                             'edApp' =>
//                                 ([
//                                     'id' => 'https://example.edu',
//                                     'type' => 'SoftwareApplication',
//                                 ]),
//                             'group' =>
//                                 ([
//                                     'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
//                                     'type' => 'CourseSection',
//                                     'courseNumber' => 'CPS 435-01',
//                                     'academicSession' => 'Fall 2016',
//                                 ]),
//                             'membership' =>
//                                 ([
//                                     'id' => 'https://example.edu/terms/201601/courses/7/sections/1/rosters/1',
//                                     'type' => 'Membership',
//                                     'member' =>
//                                         ([
//                                             'id' => 'https://example.edu/users/554433',
//                                             'type' => 'Person',
//                                         ]),
//                                     'organization' =>
//                                         ([
//                                             'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
//                                             'type' => 'CourseSection',
//                                         ]),
//                                     'roles' =>
//                                         [
//                                             0 => 'Learner',
//                                         ],
//                                     'status' => 'Active',
//                                     'dateCreated' => '2016-08-01T06:00:00.000Z',
//                                 ]),
//                             'session' =>
//                                 ([
//                                     'id' => 'https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259',
//                                     'type' => 'Session',
//                                     'startedAtTime' => '2016-11-15T10:00:00.000Z',
//                                 ]),
//                             'uuid' => '94bad4bd-a7b1-4c3e-ade4-2253efe65172',
//                         ]),
