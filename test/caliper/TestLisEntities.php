<?php
use IMSGlobal\Caliper\entities\lis\CourseOffering;
use IMSGlobal\Caliper\entities\lis\CourseSection;
use IMSGlobal\Caliper\entities\lis\Group;
use IMSGlobal\Caliper\entities\lis\Membership;
use IMSGlobal\Caliper\entities\lis\Role;
use IMSGlobal\Caliper\entities\lis\Status;
use IMSGlobal\Caliper\entities\w3c\Organization;

class TestLisEntities {
    /** @return string|Organization */
    public static function groupId() {
        return 'https://example.edu/terms/201601/courses/7/sections/1';
    }

    public static function makeGroup() {
        return (new Group(self::groupId()))
            ->setName('Discussion Group 001')
            ->setSubOrganizationOf(self::makeCourseSection())
            ->setDateCreated(TestTimes::createdTime());
    }

    public static function makeGroupMembership() {
        return (new Membership('https://example.edu/membership/003'))
            ->setMember(TestAgentEntities::makePerson())
            ->setOrganization(self::groupId())
            ->setRoles(self::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());
    }

    /** @return \IMSGlobal\Caliper\entities\lis\Course */
    public static function makeCourseSection() {
        return (new CourseSection(self::courseSectionId()))
            ->setCourseNumber('POL101')
            ->setName('American Revolution 101')
            ->setAcademicSession('Fall-2015')
            ->setSubOrganizationOf(self::makeCourseOffering())
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }

    /** @return string|Organization */
    public static function courseSectionId() {
        return 'https://example.edu/politicalScience/2015/american-revolution-101/section/001';
    }

    public static function makeSectionMembership() {
        return (new Membership('https://example.edu/membership/002'))
            ->setMember(TestAgentEntities::makePerson())
            ->setOrganization(self::courseSectionId())
            ->setRoles(self::makeMembership()->getRoles())
            ->setDateCreated(TestTimes::createdTime());

    }

    /** @return Membership */
    public static function makeMembership() {
        return (new Membership('https://example.edu/terms/201601/courses/7/sections/1/rosters/1'))
            ->setDateCreated(TestTimes::createdTime())
            ->setDescription('Roster entry')
            ->setMember(TestAgentEntities::makePerson())
            ->setName('American Revolution 101')
            ->setOrganization(new Group('https://example.edu/politicalScience/2015/american-revolution-101/section/001'))
            ->setRoles(new Role(Role::LEARNER))
            ->setStatus(new Status(Status::ACTIVE));
    }

    /** @return CourseOffering */
    public static function makeCourseOffering() {
        return (new CourseOffering('https://example.edu/politicalScience/2015/american-revolution-101'))
            ->setCourseNumber('POL101')
            ->setName('Political Science 101: The American Revolution')
            ->setAcademicSession('Fall-2015')
            ->setDateCreated(TestTimes::createdTime())
            ->setDateModified(TestTimes::modifiedTime());
    }
}