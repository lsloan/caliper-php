<?php
namespace IMSGlobal\Caliper\request;

use IMSGlobal\Caliper\entities\Entity;
use IMSGlobal\Caliper\events\Event;
use IMSGlobal\Caliper\Options;
use IMSGlobal\Caliper\Sensor;
use IMSGlobal\Caliper\util\JsonInclude;
use IMSGlobal\Caliper\util\JsonUtil;

abstract class Requestor {
    /**
     * @param Sensor $sensor
     * @param \DateTime $sendTime
     * @param Entity|Event|Entity[]|Event[] $data
     * @return Envelope
     */
    public function createEnvelope(Sensor $sensor, \DateTime $sendTime, $data) {
        return (new Envelope())
            ->setSensorId($sensor)
            ->setSendTime($sendTime)
            ->setData($data);
    }

    /**
     * Provided for parity with the caliper-java API, this is a synonym for
     * serializeData()
     *
     * @deprecated Use serializeData() instead
     *
     * @param Envelope $envelope
     * @param Options $options
     * @return string
     */
    public function serializeEnvelope(Envelope $envelope, Options $options) {
        return $this->serializeData($envelope, $options);
    }

    /**
     * @param object $data
     * @param Options $options
     * @return string
     */
    public function serializeData($data, Options $options) {
        $dataForEncoding = $data;

        $jsonInclude = $options->getJsonInclude();

        if ($jsonInclude && ($jsonInclude->getValue() !== JsonInclude::ALWAYS)) {
            $dataForEncoding = JsonUtil::preserialize($dataForEncoding, $options);
        }

        return json_encode($dataForEncoding, $options->getJsonEncodeOptions());
    }
}