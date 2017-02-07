<?php
namespace IMSGlobal\Caliper\entities\annotation;

use IMSGlobal\Caliper\entities\foaf\Agent;

class SharedAnnotation extends Annotation {
    /** @var Agent[] */
    public $withAgents = [];

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new AnnotationType(AnnotationType::SHARED_ANNOTATION));
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), [
            'withAgents' => $this->getWithAgents(),
        ]);
    }

    /** @return Agent[] withAgents */
    public function getWithAgents() {
        return $this->withAgents;
    }

    /**
     * @param Agent|Agent[] $withAgents
     * @return $this|SharedAnnotation
     */
    public function setWithAgents($withAgents) {
        if (!is_array($withAgents)) {
            $withAgents = [$withAgents];
        }

        foreach ($withAgents as $aWithAgents) {
            if (!($aWithAgents instanceof Agent)) {
                // FIXME: After PHP 5.5 is a requirement, change "IMSGlobal\Caliper\entities\foaf\Agent" string to "::class".
                throw new \InvalidArgumentException(__METHOD__ . ': array of \IMSGlobal\Caliper\entities\foaf\Agent expected');
            }
        }

        $this->withAgents = $withAgents;
        return $this;
    }
}
