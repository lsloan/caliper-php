<?php
namespace IMSGlobal\Caliper\entities\assessment;

use IMSGlobal\Caliper\entities\assignable\AssignableDigitalResource;
use IMSGlobal\Caliper\entities\assignable\AssignableDigitalResourceType;

class Assessment extends AssignableDigitalResource {
    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new AssignableDigitalResourceType(AssignableDigitalResourceType::ASSESSMENT));
    }
}
