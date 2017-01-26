<?php
namespace IMSGlobal\Caliper\entities\agent;

use IMSGlobal\Caliper\entities;

class SoftwareApplication extends entities\Entity implements entities\foaf\Agent,
    entities\schemadotorg\SoftwareApplication {
    /** @var string */
    private $version;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\EntityType(entities\EntityType::SOFTWARE_APPLICATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'version' => $this->getVersion(),
        ]);
    }

    /** @return string version */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param string $version
     * @return $this|SoftwareApplication
     */
    public function setVersion($version) {
        if (!is_string($version)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->version = $version;
        return $this;
    }

}
