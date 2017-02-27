<?php
namespace IMSGlobal\Caliper\entities\media;

use IMSGlobal\Caliper\entities;

class MediaLocation extends entities\DigitalResource implements entities\Targetable {
    /** @var string|null ISO 8601 interval */
    private $currentTime;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\DigitalResourceType(entities\DigitalResourceType::MEDIA_LOCATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'currentTime' => $this->getCurrentTime(),
        ]);
    }

    /** @return string|null duration (ISO 8601 interval) */
    public function getCurrentTime() {
        return $this->currentTime;
    }

    /**
     * @param string|null $currentTime (ISO 8601 interval)
     * @throws \InvalidArgumentException ISO 8601 interval string required
     * @return $this|MediaLocation
     */
    public function setCurrentTime($currentTime) {
        if (!is_null($currentTime)) {
            $currentTime = strval($currentTime);

            try {
                $_ = new \DateInterval($currentTime);
            } catch (\Exception $exception) {
                throw new \InvalidArgumentException(__METHOD__ . ': ISO 8601 interval string expected');
            }
        }

        $this->currentTime = $currentTime;
        return $this;
    }
}