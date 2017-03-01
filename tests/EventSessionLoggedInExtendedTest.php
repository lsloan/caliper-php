<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\SessionEvent;


/**
 * @requires PHP 5.6.28
 */
class EventSessionLoggedInExtendedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new SessionEvent())
            ->setUuid('4ec2c31e-3ec0-4fe1-a017-b81561b075d7')
            ->setActor(new Person('https://example.edu/users/554433'))
            ->setAction(new Action(Action::LOGGED_IN))
            ->setObject((new SoftwareApplication('https://example.edu'))
                ->setVersion('v2')
            )
            ->setEventTime(new \DateTime('2016-11-15T20:11:15.000Z'))
            ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                ->setUser(new Person('https://example.edu/users/554433'))
                ->setDateCreated(new \DateTime('2016-11-15T20:11:15.000Z'))
                ->setStartedAtTime(new \DateTime('2016-11-15T20:11:15.000Z')))
            ->setExtensions([
                [
                    'requestId' => 'd71016dc-ed2f-46f9-ac2c-b93f15f38fdc',
                    'hostname' => 'example.com',
                    'userAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36',
                ],
                [
                    '@context' => [
                        'id' => '@id',
                        'type' => '@type',
                        'sdo' => 'http://schema.org',
                        'xsd' => 'http://www.w3.org/2001/XMLSchema#',
                        'GeoCoordinates' => 'sdo:GeoCoordinates',
                        'latitude' => [
                            'id' => 'sdo:latitude',
                            'type' => 'xsd:decimal',
                        ],
                        'longitude' => [
                            'id' => 'sdo:longitude',
                            'type' => 'xsd:decimal',
                        ],
                    ],
                    'id' => 'https://example.com/maps/@42.27611,-83.73778,19z',
                    'type' => 'GeoCoordinates',
                    'latitude' => 42.276110000000003,
                    'longitude' => -83.737780000000001,
                ],
            ])
        );
    }
}
