<?php
class TestTimes {
    /** @return \DateTime */ 
    public static function createdTime() {
        return new \DateTime('2015-08-01T06:00:00.000Z');
    }

    /** @return \DateTime */ 
    public static function modifiedTime() {
        return new \DateTime('2015-09-02T11:30:00.000Z');
    }

    /** @return string */
    public static function durationSeconds() {
        return strval(self::endedTime()->getTimestamp() - self::startedTime()->getTimestamp());
    }

    /** @return \DateTime */ 
    public static function endedTime() {
        return new \DateTime('2015-09-15T11:05:00.000Z');
    }

    /** @return \DateTime */ 
    public static function startedTime() {
        return new \DateTime('2016-11-15T10:00:00.000Z');
    }

    /** @return \DateTime */ 
    public static function sendTime() {
        return new \DateTime('2015-09-15T11:05:01.000Z');
    }

    /** @return \DateTime */ 
    public static function publishedTime() {
        return new \DateTime('2015-08-15T09:30:00.000Z');
    }

    /** @return \DateTime */ 
    public static function activateTime() {
        return new \DateTime('2015-08-16T05:00:00.000Z');
    }

    /** @return \DateTime */ 
    public static function showTime() {
        return new \DateTime('2015-08-16T05:00:00.000Z');
    }

    /** @return \DateTime */ 
    public static function startOnTime() {
        return new \DateTime('2015-08-16T05:00:00.000Z');
    }

    /** @return \DateTime */ 
    public static function submitTime() {
        return new \DateTime('2015-09-28T11:59:59.000Z');
    }
}