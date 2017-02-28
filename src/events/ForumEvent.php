<?php
namespace IMSGlobal\Caliper\events;

class ForumEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::FORUM));
    }
}
