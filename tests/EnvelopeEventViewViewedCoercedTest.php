<?php
require_once 'CaliperTestCase.php';


/**
 * @requires PHP 5.4
 */
class EnvelopeEventViewViewedCoercedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject(
            (
            array(
                'sensor' => 'https://example.edu/sensors/1',
                'sendTime' => '2016-11-15T11:05:01.000Z',
                'dataVersion' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
                'data' =>
                    array(
                        0 =>
                            (array(
                                '@context' =>
                                    array(
                                        0 => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
                                        1 =>
                                            (array(
                                                'assignee' =>
                                                    (array(
                                                        'id' => 'Person',
                                                        'type' => 'id',
                                                    )),
                                            )),
                                        2 =>
                                            (array(
                                                'edApp' =>
                                                    (array(
                                                        'id' => 'SoftwareApplication',
                                                        'type' => 'id',
                                                    )),
                                            )),
                                        3 =>
                                            (array(
                                                'object' =>
                                                    (array(
                                                        'id' => 'Document',
                                                        'type' => 'id',
                                                    )),
                                            )),
                                    ),
                                'type' => 'ViewEvent',
                                'assignee' => 'https://example.edu/users/554433',
                                'action' => 'Viewed',
                                'object' => 'https://example.edu/etexts/201.epub',
                                'eventTime' => '2016-11-15T10:15:00.000Z',
                                'edApp' => 'https://example.edu',
                                'group' =>
                                    (array(
                                        'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
                                        'type' => 'CourseSection',
                                        'courseNumber' => 'CPS 435-01',
                                        'academicSession' => 'Fall 2016',
                                    )),
                                'membership' =>
                                    (array(
                                        '@context' =>
                                            array(
                                                0 =>
                                                    (array(
                                                        'member' =>
                                                            (array(
                                                                'id' => 'Person',
                                                                'type' => 'id',
                                                            )),
                                                    )),
                                            ),
                                        'id' => 'https://example.edu/terms/201601/courses/7/sections/1/rosters/1',
                                        'type' => 'Membership',
                                        'member' => 'https://example.edu/users/554433',
                                        'organization' =>
                                            (array(
                                                'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
                                                'type' => 'CourseSection',
                                            )),
                                        'roles' =>
                                            array(
                                                0 => 'Learner',
                                            ),
                                        'status' => 'Active',
                                        'dateCreated' => '2016-08-01T06:00:00.000Z',
                                    )),
                                'session' =>
                                    (array(
                                        'id' => 'https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259',
                                        'type' => 'Session',
                                        'startedAtTime' => '2016-11-15T10:00:00.000Z',
                                    )),
                                'uuid' => 'e6f54458-19e3-47e3-bc18-43f231c74a45',
                            )),
                    ),
            ))
        );
    }
}
