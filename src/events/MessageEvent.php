<?php
namespace IMSGlobal\Caliper\events;

class MessageEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::MESSAGE));
    }
}
