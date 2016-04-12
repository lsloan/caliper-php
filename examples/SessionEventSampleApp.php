<?php

require_once '../autoload.php';

use \IMSGlobal\Caliper\Sensor;
use \IMSGlobal\Caliper\Options;
use \IMSGlobal\Caliper\Client;
use \IMSGlobal\Caliper\entities\agent\Person;
use \IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use \IMSGlobal\Caliper\entities\reading\EPubVolume;
use \IMSGlobal\Caliper\entities\reading\Frame;
use \IMSGlobal\Caliper\entities\session\Session;
use \IMSGlobal\Caliper\events\SessionEvent;
use \IMSGlobal\Caliper\actions\Action;

class SessionEventSampleApp {
    /** @var SessionEvent */
    private $sessionEvent;
    /** @var Person */
    private $personEntity;

    /** @return Person */
    public function getPersonEntity() {
        return $this->personEntity;
    }

    /** @return SessionEvent */
    public function getSessionEvent() {
        return $this->sessionEvent;
    }

    function setUp() {
        $createdTime = new DateTime('1977-05-25T17:00:00.000Z');
        $modifiedTime = new DateTime('2015-06-24T19:48:00.000Z');
        $sessionStartTime = new DateTime('2015-12-18T11:38:00.000Z');

        $person = new Person('https://example.edu/user/poe_dameron');
        $person->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);
        $this->personEntity = $person;

        $eventObj = new SoftwareApplication('https://example.com/viewer');
        $eventObj->setName('Holocron v7')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime);

        $ePubVolume = new EPubVolume('https://example.com/viewer/book/1138#epubcfi(/4/3)');
        $ePubVolume->setName('Star Wars: The Magic of Myth')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setVersion('1st ed.');

        $targetObj = new Frame('https://example.com/viewer/book/1138#epubcfi(/4/3/1)');
        $targetObj->setName('The Resurgence of Evil')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setIsPartOf($ePubVolume)
            ->setIndex(1)
            ->setVersion('1st ed.');

        $generatedObj = new Session('https://example.com/viewer/session-19440514');
        $generatedObj->setName('session-19440514')
            ->setDateCreated($createdTime)
            ->setDateModified($modifiedTime)
            ->setActor($person)
            ->setStartedAtTime($sessionStartTime);

        $sessionEvent = new SessionEvent();
        $sessionEvent->setAction(new Action(Action::LOGGED_IN))
            ->setActor($person)
            ->setObject($eventObj)
            ->setTarget($targetObj)
            ->setGenerated($generatedObj)
            ->setEventTime($sessionStartTime);

        $this->sessionEvent = $sessionEvent;
    }
}

$sensor = new Sensor('id');

$options = (new Options())
    ->setApiKey('org.imsglobal.caliper.php.apikey')
    ->setDebug(true)
    ->setHost('http://localhost:8000/');

$sensor->registerClient('http', new Client('clientId', $options));

$sessionTest = new SessionEventSampleApp();
$sessionTest->setUp();

echo "sending...\r";
$sensor->send($sensor, $sessionTest->getSessionEvent());
echo "send() done\n";

echo "describing...\r";
$sensor->describe($sensor, $sessionTest->getPersonEntity());
echo "describe() done\n";