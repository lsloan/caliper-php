<?php
namespace IMSGlobal\Caliper\entities\media;

use IMSGlobal\Caliper\entities;

abstract class MediaObject extends entities\DigitalResource implements entities\schemadotorg\MediaObject {
    /** @var int (seconds) */
    private $duration;

    public function __construct($id) {
        parent::__construct($id);
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'duration' => $this->getDuration(),
        ]);
    }

    /** @return int duration (seconds) */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param int $duration (seconds)
     * @return $this|MediaObject
     */
    public function setDuration($duration) {
        if (!is_long($duration)) {
            throw new \InvalidArgumentException(__METHOD__ . ': long int expected');
        }

        $this->duration = $duration;
        return $this;
    }
}