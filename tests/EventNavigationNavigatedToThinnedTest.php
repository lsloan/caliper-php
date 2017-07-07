<?php
require_once 'CaliperTestCase.php';

use IMSGlobal\Caliper\actions\Action;
use IMSGlobal\Caliper\events\NavigationEvent;


/**
 * @requires PHP 5.6.28
 */
class EventNavigationNavigatedToThinnedTest extends CaliperTestCase {
    function setUp() {
        parent::setUp();


        $this->setTestObject(
            (new NavigationEvent('urn:uuid:71657137-8e6e-44f8-8499-e1c3df6810d2'))
                ->setActor(
                    new ActorReference('https://example.edu/users/554433'))
                ->setAction(
                    new Action(Action::NAVIGATED_TO))
                ->setObject(
                    new DigitalResourceReference('https://example.edu/terms/201601/courses/7/sections/1/pages/2'))
                ->setEventTime(
                    new \DateTime('2016-11-15T10:15:00.000Z'))
                ->setReferrer(
                    new ReferrerReference('https://example.edu/terms/201601/courses/7/sections/1/pages/1'))
                ->setEdApp(
                    new EdAppReference('https://example.edu'))
                ->setGroup(
                    new GroupReference('https://example.edu/terms/201601/courses/7/sections/1'))
                ->setMembership(
                    new MembershipReference('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
                ->setSession(
                    new SessionReference('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
        );
    }
}
