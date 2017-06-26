<?php
namespace IMSGlobal\Caliper\entities\outcome;

use IMSGlobal\Caliper\entities;
use IMSGlobal\Caliper\entities\assignable\Attempt;

/*
 * TODO: Check the requirements of class properties.
 * The specification (https://github.com/IMSGlobal/caliper-spec/blob/master/caliper.md#739-result)
 * is incomplete, so it's not known whether any of the properties are optional.
 */

class Result extends entities\Entity implements entities\Generatable {
    /** @var Attempt|null */
    private $attempt;
    /** @var float */
    private $normalScore;
    /** @var float */
    private $penaltyScore;
    /** @var float */
    private $extraCreditScore;
    /** @var float */
    private $totalScore;
    /** @var float */
    private $curvedTotalScore;
    /** @var float */
    private $curveFactor;
    /** @var string */
    private $comment;
    /** @var entities\foaf\Agent */
    private $scoredBy;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType(new entities\EntityType(entities\EntityType::RESULT));
    }

    public function jsonSerialize() {
        return $this->removeChildEntitySameContexts(array_merge(parent::jsonSerialize(), [
            'attempt' => $this->getAttempt(),
            'normalScore' => $this->getNormalScore(),
            'penaltyScore' => $this->getPenaltyScore(),
            'extraCreditScore' => $this->getExtraCreditScore(),
            'totalScore' => $this->getTotalScore(),
            'curvedTotalScore' => $this->getCurvedTotalScore(),
            'curveFactor' => $this->getCurveFactor(),
            'comment' => $this->getComment(),
            'scoredBy' => $this->getScoredBy(),
        ]));
    }

    /** @return Attempt|null */
    public function getAttempt() {
        return $this->attempt;
    }

    /**
     * @param Attempt|null $attempt
     * @throws \InvalidArgumentException Attempt required
     * @return $this|Result
     */
    public function setAttempt($attempt) {
        if (is_null($attempt) || ($attempt instanceof Attempt)) {
            $this->attempt = $attempt;
            return $this;
        }

        throw new \InvalidArgumentException(__METHOD__ . ': Attempt expected');
    }

    /** @return float normalScore */
    public function getNormalScore() {
        return $this->normalScore;
    }

    /**
     * @param float $normalScore
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setNormalScore($normalScore) {
        if (!is_float($normalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->normalScore = $normalScore;
        return $this;
    }

    /** @return float penaltyScore */
    public function getPenaltyScore() {
        return $this->penaltyScore;
    }

    /**
     * @param float $penaltyScore
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setPenaltyScore($penaltyScore) {
        if (!is_float($penaltyScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->penaltyScore = $penaltyScore;
        return $this;
    }

    /** @return float extraCreditScore */
    public function getExtraCreditScore() {
        return $this->extraCreditScore;
    }

    /**
     * @param float $extraCreditScore
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setExtraCreditScore($extraCreditScore) {
        if (!is_float($extraCreditScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->extraCreditScore = $extraCreditScore;
        return $this;
    }

    /** @return float totalScore */
    public function getTotalScore() {
        return $this->totalScore;
    }

    /**
     * @param float $totalScore
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setTotalScore($totalScore) {
        if (!is_float($totalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->totalScore = $totalScore;
        return $this;
    }

    /** @return float curvedTotalScore */
    public function getCurvedTotalScore() {
        return $this->curvedTotalScore;
    }

    /**
     * @param float $curvedTotalScore
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setCurvedTotalScore($curvedTotalScore) {
        if (!is_float($curvedTotalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->curvedTotalScore = $curvedTotalScore;
        return $this;
    }

    /** @return float curveFactor */
    public function getCurveFactor() {
        return $this->curveFactor;
    }

    /**
     * @param float $curveFactor
     * @throws \InvalidArgumentException float required
     * @return $this|Result
     */
    public function setCurveFactor($curveFactor) {
        if (!is_float($curveFactor)) {
            throw new \InvalidArgumentException(__METHOD__ . ': float expected');
        }

        $this->curveFactor = $curveFactor;
        return $this;
    }

    /** @return string comment */
    public function getComment() {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @throws \InvalidArgumentException string required
     * @return $this|Result
     */
    public function setComment($comment) {
        if (!is_string($comment)) {
            throw new \InvalidArgumentException(__METHOD__ . ': string expected');
        }

        $this->comment = $comment;
        return $this;
    }

    /** @return entities\foaf\Agent scoredBy */
    public function getScoredBy() {
        return $this->scoredBy;
    }

    /**
     * @param entities\foaf\Agent $scoredBy
     * @return $this|Result
     */
    public function setScoredBy(entities\foaf\Agent $scoredBy) {
        $this->scoredBy = $scoredBy;
        return $this;
    }
}
