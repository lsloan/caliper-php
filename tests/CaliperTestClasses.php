<?php
use IMSGlobal\Caliper\entities\agent\Organization;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\DigitalResource;

trait SerializeIdOnly {
    /** @var string */
    protected $id;

    function jsonSerialize() {
        return $this->id;
    }
}

class DigitalResourceId extends DigitalResource {
    use SerializeIdOnly;
}

class OrganizationId extends Organization {
    use SerializeIdOnly;
}

class PersonID extends Person {
    use SerializeIdOnly;

}
