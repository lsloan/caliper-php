<?php
namespace IMSGlobal\Caliper\util;

class TimestampUtil {
    /**
     * Given a \DateTime object, return a string representation in ISO 8601 format, including
     * milliseconds, in UTC.
     *
     * @param \DateTime $timestamp
     * @return string formatted timestamp
     */
    static function formatTimeISO8601MillisUTC($timestamp) {
        if ($timestamp == null) {
            return null;
        }

        $timestampClone = (clone $timestamp);
        $timestampClone->setTimezone(new \DateTimeZone('UTC'));

        return substr($timestampClone->format('Y-m-d\TH:i:s.u'), 0, -3) . 'Z'; // truncate μs to ms
    }
}