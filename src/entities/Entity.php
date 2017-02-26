<?php
namespace IMSGlobal\Caliper\entities;

use IMSGlobal\Caliper\context\Context;
use IMSGlobal\Caliper\entities;
use IMSGlobal\Caliper\util;
use IMSGlobal\Caliper\util\ClassUtil;

abstract class Entity extends ClassUtil implements \JsonSerializable, entities\schemadotorg\Thing {
    /** @var string */
    protected $id;
    /** @var Context|null */
    protected $context;
    /** @var Type */
    private $type;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var string[] */
    private $extensions;
    /** @var \DateTime */
    private $dateCreated;
    /** @var \DateTime */
    private $dateModified;

    function __construct($id) {
        $this->setId($id)
            ->setContext(new Context(Context::CONTEXT));
    }

    public function jsonSerialize() {
        return $this->removeChildEntitySameContexts([
            '@context' => $this->getContext(),
            'id' => $this->getId(),
            'type' => $this->getType(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'extensions' => $this->getExtensions(),
            'dateCreated' => util\TimestampUtil::formatTimeISO8601MillisUTC($this->getDateCreated()),
            'dateModified' => util\TimestampUtil::formatTimeISO8601MillisUTC($this->getDateModified()),
        ]);
    }

    /**
     * @param array $serializationData Object property array (from $this->jsonSerialize())
     * @return array $serializationData with possible updates
     */
    protected function removeChildEntitySameContexts(array $serializationData) {
        return parent::removeChildEntitySameContextsBase($serializationData, $this);
    }

    /** @return Context|null */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param Context|null $context
     * @throws \InvalidArgumentException Context object or null required
     * @return $this|Entity
     */
    public function setContext($context) {
        if (is_null($context) || ($context instanceof Context)) {
            $this->context = $context;
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': instance of Context expected');
    }

    /** @return string id */
    public function getId() {
        return $this->id;
    }

    /**
     * @param string $id
     * @throws \InvalidArgumentException string required
     * @return $this|Entity
     */
    public function setId($id) {
        if (!is_string($id)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->id = $id;
        return $this;
    }

    /** @return Type type */
    public function getType() {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return $this|Entity
     */
    public function setType(Type $type) {
        $this->type = $type;
        return $this;
    }

    /** @return string name */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws \InvalidArgumentException string required
     * @return $this|Entity
     */
    public function setName($name) {
        if (!is_string($name)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->name = $name;
        return $this;
    }

    /** @return string description */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     * @throws \InvalidArgumentException string required
     * @return $this|Entity
     */
    public function setDescription($description) {
        if (!is_string($description)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->description = $description;
        return $this;
    }

    /** @return string[] extensions */
    public function getExtensions() {
        return $this->extensions;
    }

    /**
     * @param \array[]|null $extensions An array of associative arrays
     * @throws \InvalidArgumentException array of associative arrays or null required
     * @return Entity
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

    /** @return \DateTime dateCreated */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     * @return $this|Entity
     */
    public function setDateCreated(\DateTime $dateCreated) {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /** @return \DateTime dateModified */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param \DateTime $dateModified
     * @return $this|Entity
     */
    public function setDateModified(\DateTime $dateModified) {
        $this->dateModified = $dateModified;
        return $this;
    }


}

