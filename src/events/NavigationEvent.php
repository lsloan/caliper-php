<?php
namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\entities;
use IMSGlobal\Caliper\actions;

class NavigationEvent extends Event {
    /**
     * @deprecated 1.2 See `Event.referrer`
     * @var entities\DigitalResource
     */
    private $navigatedFrom;

    public function __construct() {
        parent::__construct();
        $this->setType(new EventType(EventType::NAVIGATION))
            ->setAction(new actions\Action(actions\Action::NAVIGATED_TO));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'navigatedFrom' => $this->getNavigatedFrom(),
        ]);
    }

    /**
     * @deprecated 1.2 See `Event.referrer`
     * @return entities\DigitalResource navigatedFrom
     */
    public function getNavigatedFrom() {
        return $this->navigatedFrom;
    }

    /**
     * @deprecated 1.2 See `Event.referrer`
     * @param entities\DigitalResource $navigatedFrom
     * @return $this|NavigationEvent
     */
    public function setNavigatedFrom(entities\DigitalResource $navigatedFrom) {
        $this->navigatedFrom = $navigatedFrom;
        return $this;
    }
}

