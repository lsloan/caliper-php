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
    /** @var double */
    private $normalScore;
    /** @var double */
    private $penaltyScore;
    /** @var double */
    private $extraCreditScore;
    /** @var double */
    private $totalScore;
    /** @var double */
    private $curvedTotalScore;
    /** @var double */
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

    /** @return double normalScore */
    public function getNormalScore() {
        return $this->normalScore;
    }

    /**
     * @param double $normalScore
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setNormalScore($normalScore) {
        if (!is_double($normalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
        }

        $this->normalScore = $normalScore;
        return $this;
    }

    /** @return double penaltyScore */
    public function getPenaltyScore() {
        return $this->penaltyScore;
    }

    /**
     * @param double $penaltyScore
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setPenaltyScore($penaltyScore) {
        if (!is_double($penaltyScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
        }

        $this->penaltyScore = $penaltyScore;
        return $this;
    }

    /** @return double extraCreditScore */
    public function getExtraCreditScore() {
        return $this->extraCreditScore;
    }

    /**
     * @param double $extraCreditScore
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setExtraCreditScore($extraCreditScore) {
        if (!is_double($extraCreditScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
        }

        $this->extraCreditScore = $extraCreditScore;
        return $this;
    }

    /** @return double totalScore */
    public function getTotalScore() {
        return $this->totalScore;
    }

    /**
     * @param double $totalScore
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setTotalScore($totalScore) {
        if (!is_double($totalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
        }

        $this->totalScore = $totalScore;
        return $this;
    }

    /** @return double curvedTotalScore */
    public function getCurvedTotalScore() {
        return $this->curvedTotalScore;
    }

    /**
     * @param double $curvedTotalScore
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setCurvedTotalScore($curvedTotalScore) {
        if (!is_double($curvedTotalScore)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
        }

        $this->curvedTotalScore = $curvedTotalScore;
        return $this;
    }

    /** @return double curveFactor */
    public function getCurveFactor() {
        return $this->curveFactor;
    }

    /**
     * @param double $curveFactor
     * @throws \InvalidArgumentException double required
     * @return $this|Result
     */
    public function setCurveFactor($curveFactor) {
        if (!is_double($curveFactor)) {
            throw new \InvalidArgumentException(__METHOD__ . ': double expected');
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
