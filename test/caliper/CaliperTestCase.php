<?php
require_once realpath(dirname(__FILE__) . '/../../lib/Caliper/Sensor.php');
require_once 'Caliper/Options.php';
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAgentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAnnotationEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssessmentEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestAssignableEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestLisEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestMediaEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestReadingEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestRequests.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestResponseEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestSessionEntities.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/caliper/TestTimes.php');
require_once realpath(CALIPER_LIB_PATH . '/../test/util/TestUtilities.php');

class CaliperTestCase extends PHPUnit_Framework_TestCase {
    /** @var string */
    protected $fixtureDirectoryPath;
    /** @var string */
    protected $fixtureFilename;
    /** @var object */
    private $testObject;

    /** @return string */
    public function getFixtureDirectoryPath() {
        return $this->fixtureDirectoryPath;
    }

    /**
     * @param string $fixtureDirectoryPath
     * @return $this
     */
    public function setFixtureDirectoryPath($fixtureDirectoryPath) {
        $this->fixtureDirectoryPath = $fixtureDirectoryPath;
        return $this;
    }

    /** @return object */
    public function getTestObject() {
        return $this->testObject;
    }

    /**
     * @param object $testObject
     * @return $this
     */
    public function setTestObject($testObject) {
        $this->testObject = $testObject;
        return $this;
    }

    /**
     * Return the absolute path to the fixture file by combining CALIPER_LIB_PATH,
     * the fixture directory previously set with setFixtureDirectoryPath(), the name of
     * the test class, and the fixture filename extension.  It's intended to make the path
     * reference the appropriate caliper-common-fixtures files which are installed in the
     * same directory as caliper-php.
     *
     * @param string $testClass Name of the test class
     * @param string $extension <i>(Optional)</i> Extension of the fixture file, ".json" by default
     * @return string
     */
    public function makeFixturePathFromClassName($testClass, $extension = '.json') {
        $testName = str_replace('Test', null, $testClass);
        return realpath(CALIPER_LIB_PATH . DIRECTORY_SEPARATOR . $this->getFixtureDirectoryPath()
            . DIRECTORY_SEPARATOR . 'caliper' . $testName . $extension);
    }

    /** @return string */
    public function getFixtureFilename() {
        return $this->fixtureFilename;
    }

    /**
     * @param string $fixtureFilename
     * @return $this
     */
    public function setFixtureFilename($fixtureFilename) {
        $this->fixtureFilename = $fixtureFilename;
        return $this;
    }

    function setUp() {
        parent::setUp();
        date_default_timezone_set('UTC');

        $this->setFixtureDirectoryPath('/../../caliper-common-fixtures/src/test/resources/fixtures/');

        $calledClass = get_called_class();
        $this->setFixtureFilename($this->makeFixturePathFromClassName($calledClass));
    }

    function testObjectSerializesToJson() {
        $testOptions = (
        (new Options())
            ->setJsonInclude(JsonInclude::NON_EMPTY)
        );

        $testRequestor = new HttpRequestor($testOptions);

        $testJson = $testRequestor->serializeData($this->getTestObject());
        $testFixtureFilePath = $this->getFixtureFilename();

        if ($testFixtureFilePath === false) {
            throw new PHPUnit_Runner_Exception('Unable to access fixture file "' .
                CALIPER_LIB_PATH . $this->getFixtureFilename() . '"');
        }

        TestUtilities::saveFormattedFixtureAndOutputJson($testFixtureFilePath, $testJson, get_called_class());

        $this->assertJsonStringEqualsJsonFile($testFixtureFilePath, $testJson);
    }
}