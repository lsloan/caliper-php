<?php
namespace IMSGlobal\Caliper\events;

class ThreadEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::THREAD));
    }
}
