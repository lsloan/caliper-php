<?php
namespace IMSGlobal\Caliper\events;

class AssessmentItemEvent extends Event {
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::ASSESSMENT_ITEM));
    }
}
