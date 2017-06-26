<?php

namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;
use IMSGlobal\Caliper\entities\assignable\Attempt;

class OutcomeEvent extends Event {
    /** @var Attempt */
    private $object;

    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::OUTCOME))
            ->setAction(new actions\Action(actions\Action::GRADED));
    }

    /** @return Attempt object */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param Attempt $object
     * @throws \InvalidArgumentException Attempt expected
     * @return $this|AssessmentEvent
     */
    public function setObject($object) {
        if (is_null($object) || ($object instanceof Attempt)) {
            $this->object = $object;
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': Attempt expected');
    }
}
