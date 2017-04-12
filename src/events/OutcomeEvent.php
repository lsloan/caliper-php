<?php
namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;

class OutcomeEvent extends Event {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::OUTCOME))
            ->setAction(new actions\Action(actions\Action::GRADED));
    }
}
