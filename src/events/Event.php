<?php
namespace IMSGlobal\Caliper\events;

use IMSGlobal\Caliper\actions;
use IMSGlobal\Caliper\context;
use IMSGlobal\Caliper\entities;
use IMSGlobal\Caliper\util;

abstract class Event extends util\ClassUtil implements \JsonSerializable {
    /** @var context\Context */
    private $context;
    /** @var EventType */
    private $type;
    /** @var entities\foaf\Agent */
    private $actor;
    /** @var actions\Action */
    private $action;
    /** @var object */
    private $object;
    /** @var entities\Targetable */
    private $target;
    /** @var entities\Generatable */
    private $generated;
    /** @var entities\Referrable */
    private $referrer;
    /** @var \DateTime */
    private $eventTime;
    /** @var entities\agent\SoftwareApplication */
    private $edApp;
    /** @var entities\agent\Organization */
    private $group;
    /** @var entities\lis\Membership */
    private $membership;
    /** @var entities\session\Session */
    private $session;
    /** @var entities\session\LtiSession */
    private $federatedSession;
    /** @var array[] */
    private $extensions;
    /** @var string */
    private $uuid;

    public function __construct() {
        $this->setContext(new context\Context(context\Context::CONTEXT));
    }

    public function jsonSerialize() {
        if ($this->getUuid() === null) {
            $this->setUuid(uniqid());
        }

        return [
            '@context' => $this->getContext(),
            'type' => $this->getType(),
            'actor' => $this->getActor(),
            'action' => $this->getAction(),
            'object' => $this->getObject(),
            'target' => $this->getTarget(),
            'generated' => $this->getGenerated(),
            'referrer' => $this->getReferrer(),
            'eventTime' => util\TimestampUtil::formatTimeISO8601MillisUTC($this->getEventTime()),
            'edApp' => $this->getEdApp(),
            'group' => $this->getGroup(),
            'membership' => $this->getMembership(),
            'session' => $this->getSession(),
            'uuid' => $this->getUuid(),
            'federatedSession' => $this->getFederatedSession(),
        ];
    }

    /** @return string */
    public function getUuid() {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return Event
     */
    public function setUuid($uuid) {
        $this->uuid = strval($uuid);
        return $this;
    }

    /** @return context\Context context */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param context\Context $context
     * @return $this|Event
     */
    public function setContext(context\Context $context) {
        $this->context = $context;
        return $this;
    }

    /** @return EventType type */
    public function getType() {
        return $this->type;
    }

    /**
     * @param EventType $type
     * @return $this|Event
     */
    public function setType(EventType $type) {
        $this->type = $type;
        return $this;
    }

    /** @return entities\foaf\Agent actor */
    public function getActor() {
        return $this->actor;
    }

    /**
     * @param entities\foaf\Agent $actor
     * @return $this|Event
     */
    public function setActor(entities\foaf\Agent $actor) {
        $this->actor = $actor;
        return $this;
    }

    /** @return actions\Action action */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param actions\Action $action
     * @return $this|Event
     */
    public function setAction(actions\Action $action) {
        $this->action = $action;
        return $this;
    }

    /** @return object object */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param object $object
     * @return $this|Event
     */
    public function setObject($object) {
        if (!is_object($object)) {
            throw new \InvalidArgumentException(__METHOD__ . ': object expected');
        }

        $this->object = $object;
        return $this;
    }

    /** @return entities\Targetable target */
    public function getTarget() {
        return $this->target;
    }

    /**
     * @param entities\Targetable $target
     * @return $this|Event
     */
    public function setTarget(entities\Targetable $target) {
        $this->target = $target;
        return $this;
    }

    /** @return entities\Generatable generated */
    public function getGenerated() {
        return $this->generated;
    }

    /**
     * @param entities\Generatable $generated
     * @return $this|Event
     */
    public function setGenerated(entities\Generatable $generated) {
        $this->generated = $generated;
        return $this;
    }

    /** @return entities\Referrable */
    public function getReferrer() {
        return $this->referrer;
    }

    /**
     * @param entities\Referrable $referrer
     * @return $this
     */
    public function setReferrer(entities\Referrable $referrer) {
        $this->referrer = $referrer;
        return $this;
    }

    /** @return \DateTime eventTime */
    public function getEventTime() {
        return $this->eventTime;
    }

    /**
     * @param \DateTime $eventTime
     * @return $this|Event
     */
    public function setEventTime(\DateTime $eventTime) {
        $this->eventTime = $eventTime;
        return $this;
    }

    /** @return entities\agent\SoftwareApplication edApp */
    public function getEdApp() {
        return $this->edApp;
    }

    /**
     * @param entities\agent\SoftwareApplication $edApp
     * @return $this|Event
     */
    public function setEdApp(entities\agent\SoftwareApplication $edApp) {
        $this->edApp = $edApp;
        return $this;
    }

    /** @return entities\agent\Organization group */
    public function getGroup() {
        return $this->group;
    }

    /**
     * @param entities\w3c\Organization $group
     * @return $this|Event
     */
    public function setGroup(entities\w3c\Organization $group) {
        $this->group = $group;
        return $this;
    }

    /** @return entities\w3c\Membership membership */
    public function getMembership() {
        return $this->membership;
    }

    /**
     * @param entities\w3c\Membership $membership
     * @return $this|Event
     */
    public function setMembership(entities\w3c\Membership $membership) {
        $this->membership = $membership;
        return $this;
    }

    /** @return entities\session\Session */
    public function getSession() {
        return $this->session;
    }

    /**
     * @param entities\session\Session $session
     * @return Event
     */
    public function setSession(entities\session\Session $session) {
        $this->session = $session;
        return $this;
    }

    /** @return entities\session\LtiSession */
    public function getFederatedSession() {
        return $this->federatedSession;
    }

    /**
     * @param entities\session\LtiSession $federatedSession
     * @return $this|Event
     */
    public function setFederatedSession(entities\session\LtiSession $federatedSession) {
        $this->federatedSession = $federatedSession;
        return $this;
    }

    /** @return \array[] */
    public function getExtensions() {
        return $this->extensions;
    }

    /**
     * @param \array[]|null $extensions An array of associative arrays
     * @return Event
     */
    public function setExtensions($extensions) {
        if ($extensions !== null) {
            if (!is_array($extensions)) {
                $extensions = [$extensions];
            } else {
                $extensions = array_values($extensions);
            }

            foreach ($extensions as $anExtension) {
                if (!util\Type::isStringKeyedArray($anExtension)) {
                    throw new \InvalidArgumentException(__METHOD__ . ': array of associative arrays expected');
                }
            }
        }

        $this->extensions = $extensions;
        return $this;
    }
}
