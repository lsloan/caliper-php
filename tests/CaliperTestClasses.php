<?php
use IMSGlobal\Caliper\entities\agent\Organization;
use IMSGlobal\Caliper\entities\agent\Person;
use IMSGlobal\Caliper\entities\agent\SoftwareApplication;
use IMSGlobal\Caliper\entities\assignable\Attempt;
use IMSGlobal\Caliper\entities\DigitalResource;
use IMSGlobal\Caliper\entities\Entity;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\session\Session;

trait SerializeIdOnly {
    /** @var string */
    protected $id;

    function jsonSerialize() {
        return $this->id;
    }
}

class PersonReference extends Person {
    use SerializeIdOnly;
}

class ActorReference extends PersonReference {
}

class DigitalResourceReference extends DigitalResource {
    use SerializeIdOnly;
}

class AnnotatedReference extends DigitalResourceReference {
}

class AnnotatorReference extends PersonReference {
}

class AssessmentReference extends DigitalResourceReference {
}

class AssignableReference extends DigitalResourceReference {
}

class AssigneeReference extends PersonReference {
}

class AttemptReference extends Attempt {
    use SerializeIdOnly;
}

class EdAppReference extends SoftwareApplication {
    use SerializeIdOnly;
}

class OrganizationReference extends Organization {
    use SerializeIdOnly;
}

class GroupReference extends OrganizationReference {
}

class IsPartOfReference extends AttemptReference {
}

class MemberReference extends PersonReference {
}

class MembershipReference extends Membership {
    use SerializeIdOnly;
}

class ObjectReference extends Entity {
    use SerializeIdOnly;
}

class ReferrerReference extends DigitalResource {
    use SerializeIdOnly;
}

class ScoredByReference extends EdAppReference {
}

class SessionReference extends Session {
    use SerializeIdOnly;
}

class UserReference extends PersonReference {
}

