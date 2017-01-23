<?php
namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;

class NavigationEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::NAVIGATION))
            ->setAction(new actions\Action(actions\Action::NAVIGATED_TO));
    }
}
