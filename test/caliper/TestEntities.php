<?php
use IMSGlobal\Caliper\entities\LearningObjective;

class TestEntities {
    /** @return LearningObjective */
    public static function makeLearningObjective() {
        return (new LearningObjective('https://example.edu/american-revolution-101/personalities/learn'))
            ->setDateCreated(TestTimes::createdTime());
    }
}