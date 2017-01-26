<?php
use IMSGlobal\Caliper\entities\session\Session;

class TestSessionEntities {
    /** @return Session */
    public static function makeSession() {
        return (new Session('https://example.edu/sessions/1f6442a482de72ea6ad134943812bff564a76259'))
            ->setStartedAtTime(TestTimes::startedTime());
    }
}