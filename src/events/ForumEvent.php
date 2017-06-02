<?php
namespace IMSGlobal\Caliper\events;

class ForumEvent extends Event {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::FORUM));
    }
}
