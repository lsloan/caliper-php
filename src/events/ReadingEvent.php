<?php
namespace IMSGlobal\Caliper\events;

/**
 * Class ReadingEvent
 *
 * @deprecated 1.2
 * @package IMSGlobal\Caliper\events
 */
class ReadingEvent extends Event {
    /**
     * ReadingEvent constructor.
     *
     * @deprecated 1.2
     */
    public function __construct($id = null) {
        parent::__construct($id);
        $this->setType(new EventType(EventType::READING));
    }
}
