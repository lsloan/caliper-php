<?php
namespace IMSGlobal\Caliper\entities\annotation;

use IMSGlobal\Caliper\entities;

/**
 *         The super-class of all Annotation types.
 *
 *         Direct sub-types can include - Highlight, Attachment, etc. - all of
 *         which are specified in the Caliper Annotation Metric Profile
 *
 */
abstract class Annotation extends entities\Entity implements entities\Generatable {
    /** @var entities\foaf\Agent */
    private $actor;
    /** @var entities\DigitalResource */
    private $annotated;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\EntityType(entities\EntityType::ANNOTATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'actor' => $this->getActor(),
            'annotated' => $this->getAnnotated(),
        ]);
    }

    /** @return entities\foaf\Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param entities\foaf\Agent $actor
     * @return $this|Annotation
     */
    public function setActor(entities\foaf\Agent $actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return entities\DigitalResource annotated */
    public function getAnnotated() {
        return $this->annotated;
    }

    /**
     * @param entities\DigitalResource $annotated
     * @return $this|Annotation
     */
    public function setAnnotated(entities\DigitalResource $annotated) {
        $this->annotated = $annotated;
        return $this;
    }
}

