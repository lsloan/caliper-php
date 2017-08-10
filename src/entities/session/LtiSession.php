<?php
namespace IMSGlobal\Caliper\entities\session;

use IMSGlobal\Caliper\entities;

class LtiSession extends Session {
    /** @var mixed */
    private $messageParameters = null;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\EntityType(entities\EntityType::LTI_SESSION));
    }

    public function jsonSerialize() {
        return $this->removeChildEntitySameContexts(array_merge(parent::jsonSerialize(), [
            'messageParameters' => $this->getMessageParameters(),
        ]));
    }

    /** @return mixed */
    public function getMessageParameters() {
        return $this->messageParameters;
    }

    /**
     * @param mixed $messageParameters
     * @return LtiSession
     */
    public function setMessageParameters($messageParameters) {
        $this->messageParameters = $messageParameters;
        return $this;
    }

}
