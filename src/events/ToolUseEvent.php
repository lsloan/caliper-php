<?php
namespace IMSGlobal\Caliper\events;

class ToolUseEvent extends Event {
    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::TOOL_USE));
    }
}
