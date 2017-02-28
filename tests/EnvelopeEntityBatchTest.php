<?php
require_once 'CaliperTestCase.php';


/**
 * @requires PHP 5.4
 */
class EnvelopeEntityBatchTest extends CaliperTestCase {
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
                                'id' => 'https://example.edu/users/554433',
                                'type' => 'Person',
                                'dateCreated' => '2016-08-01T06:00:00.000Z',
                                'dateModified' => '2016-09-02T11:30:00.000Z',
                            )),
                        1 =>
                            (array(
                                '@context' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
                                'id' => 'https://example.edu/etexts/201.epub',
                                'type' => 'Document',
                                'name' => 'IMS Caliper Implementation Guide',
                                'creators' =>
                                    array(
                                        0 =>
                                            (array(
                                                'id' => 'https://example.edu/people/12345',
                                                'type' => 'Person',
                                            )),
                                        1 =>
                                            (array(
                                                'id' => 'https://example.com/staff/56789',
                                                'type' => 'Person',
                                            )),
                                    ),
                                'dateCreated' => '2016-10-01T06:00:00.000Z',
                                'version' => '1.1',
                            )),
                        2 =>
                            (array(
                                '@context' => 'http://purl.imsglobal.org/ctx/caliper/v1p1',
                                'id' => 'https://example.edu/terms/201601/courses/7/sections/1/resources/2',
                                'type' => 'DigitalResourceCollection',
                                'name' => 'Video Collection',
                                'items' =>
                                    array(
                                        0 =>
                                            (array(
                                                'id' => 'https://example.edu/videos/1225',
                                                'type' => 'VideoObject',
                                                'mediaType' => 'video/ogg',
                                                'name' => 'Introduction to IMS Caliper',
                                                'dateCreated' => '2016-08-01T06:00:00.000Z',
                                                'duration' => 'PT1H12M27S',
                                                'version' => '1.1',
                                            )),
                                        1 =>
                                            (array(
                                                'id' => 'https://example.edu/videos/5629',
                                                'type' => 'VideoObject',
                                                'mediaType' => 'video/ogg',
                                                'name' => 'IMS Caliper Activity Profiles',
                                                'dateCreated' => '2016-08-01T06:00:00.000Z',
                                                'duration' => 'PT55M13S',
                                                'version' => '1.1.1',
                                            )),
                                    ),
                                'isPartOf' =>
                                    (array(
                                        'id' => 'https://example.edu/terms/201601/courses/7/sections/1',
                                        'type' => 'CourseSection',
                                        'subOrganizationOf' =>
                                            (array(
                                                'id' => 'https://example.edu/terms/201601/courses/7',
                                                'type' => 'CourseOffering',
                                            )),
                                    )),
                                'dateCreated' => '2016-08-01T06:00:00.000Z',
                                'dateModified' => '2016-09-02T11:30:00.000Z',
                            )),
                    ),
            ))
        );
    }
}
