<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\session\Session;
use IMSGlobal\Caliper\events\SessionEvent;


/**
 * @requires PHP 5.4
 */
class EventSessionLoggedInTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();

        $this->setTestObject((new SessionEvent())
            ->setUuid('fcd495d0-3740-4298-9bec-1154571dc211')
            ->setActor(new Person('https://example.edu/users/554433'))
            ->setAction(new Action(Action::LOGGED_IN))
            ->setObject((new SoftwareApplication('https://example.edu'))
                ->setVersion('v2')
            )
            ->setEventTime(new \DateTime('2016-11-15T10:15:00.000Z'))
            ->setSession((new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
                ->setUser(new Person('https://example.edu/users/554433'))
                ->setDateCreated(new \DateTime('2016-11-15T10:00:00.000Z'))
                ->setStartedAtTime(new \DateTime('2016-11-15T10:00:00.000Z')))
        );
    }
}
