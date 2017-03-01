<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\session\LtiSession;


/**
 * @requires PHP 5.6.28
 */
class EntityLtiSessionTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new LtiSession('https://example.com/sessions/b533eb02823f31024e6b7f53436c42fb99b31241'))
            ->setUser(new Person('https://example.edu/users/554433'))
            ->setLaunchParameters([
                'lti_message_type' => 'basic-lti-launch-request',
                'lti_version' => 'LTI-2p0',
                'resource_link_id' => '88391-e1919-bb3456',
                'context_id' => '8213060-006f-27b2066ac545',
                'launch_presentation_document_target' => 'iframe',
                'launch_presentation_height' => 240,
                'launch_presentation_return_url' => 'https://example.edu/terms/201601/courses/7/sections/1/pages/5',
                'launch_presentation_width' => 320,
                'roles' => 'Learner,Student',
                'tool_consumer_instance_guid' => 'example.edu',
                'user_id' => '0ae836b9-7fc9-4060-006f-27b2066ac545',
                'context_type' => 'CourseSection',
                'launch_presentation_locale' => 'en-US',
                'launch_presentation_css_url' => 'https://example.edu/css/tool.css',
                'role_scope_mentor' => 'f5b2cc6c-8c5c-24e8-75cc-fac5,dc19e42c-b0fe-68b8-167e-4b1a',
                'custom_caliper_session_id' => 'https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259',
                'custom_context_title' => 'CPS 435 Learning Analytics',
                'custom_context_label' => 'CPS 435',
                'custom_resource_link_title' => 'LTI tool',
                'custom_user_image' => 'https://example.edu/users/554433/profile/avatar.jpg',
                'ext_vnd_instructor' => [
                    '@context' => [
                        'sdo' => 'http://schema.org/',
                        'xsd' => 'http://www.w3.org/2001/XMLSchema#',
                        'jobTitle' => [
                            'id' => 'sdo:jobTitle',
                            'type' => 'xsd:string',
                        ],
                        'givenName' => [
                            'id' => 'sdo:givenName',
                            'type' => 'xsd:string',
                        ],
                        'familyName' => [
                            'id' => 'sdo:familyName',
                            'type' => 'xsd:string',
                        ],
                        'email' => [
                            'id' => 'sdo:email',
                            'type' => 'xsd:string',
                        ],
                        'url' => [
                            'id' => 'sdo:url',
                            'type' => 'xsd:string',
                        ],
                    ],
                    'id' => 'https://example.edu/faculty/trighaversine',
                    'type' => 'Person',
                    'jobTitle' => 'Professor',
                    'givenName' => 'Trig',
                    'familyName' => 'Haversine',
                    'email' => 'trighaversine@example.edu',
                    'url' => 'https://example.edu/faculty/trighaversine',
                ],
            ])
            ->setDateCreated(new \DateTime('2016-11-15T10:15:00.000Z'))
            ->setStartedAtTime(new \DateTime('2016-11-15T10:15:00.000Z')));
    }
}
