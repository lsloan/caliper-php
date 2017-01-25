<?php
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;

class TestAgentEntities {
    /** @return SoftwareApplication */
    public static function makeAssessmentApplication() {
        return (new SoftwareApplication('https://example.com/super-assessment-tool'))
            ->setName('Super Assessment Tool')
            ->setDateCreated(TestTimes::createdTime());
    }

    public static function makeMediaApplication() {
        return (new SoftwareApplication('https://example.com/super-media-tool'))
            ->setName('Super Media Tool')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return Person */
    public static function makePerson() {
        return (new Person('https://example.edu/users/554433'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return SoftwareApplication */
    public static function makeReadingApplication() {
        return (new SoftwareApplication('https://example.edu'))
            ->setName('ePub Reader')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return array */
    public static function makeWithAgents() {
        return [
            (new Person('https://example.edu/user/657585'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime()),
            (new Person('https://example.edu/user/667788'))
                ->setDateCreated(TestTimes::createdTime())
                ->setDateModified(TestTimes::modifiedTime())
        ];
    }
}