<?php
require_once 'CaliperTestCase.php';


/**
 * @requires PHP 5.4
 */
class EnvelopeEntitySingleTest extends CaliperTestCase {
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
                                '@context' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
                                'id' => 'https://example.edu/terms/201601/courses/7/sections/1/resources/1/syllabus.pdf',
                                'type' => 'DigitalResource',
                                'name' => 'Course Syllabus',
                                'mediaType' => 'application/pdf',
                                'creators' =>
                                    array(
                                        0 =>
                                            (array(
                                                'id' => 'https://example.edu/users/223344',
                                                'type' => 'Person',
                                            )),
                                    ),
                                'isPartOf' =>
                                    (array(
                                        'id' => 'https://example.edu/terms/201601/courses/7/sections/1/resources/1',
                                        'type' => 'DigitalResourceCollection',
                                        'name' => 'Course Assets',
                                        'isPartOf' =>
                                            (array(
                                                'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
                                                'type' => 'CourseSection',
                                            )),
                                    )),
                                'dateCreated' => '2016-08-02T11:32:00.000Z',
                            )),
                    ),
            ))
        );
    }
}
