<?php
namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;

class ViewEvent extends Event {

    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::VIEW))
            ->setAction(new actions\Action(actions\Action::VIEWED));
    }
}
