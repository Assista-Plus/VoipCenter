<?php

namespace TijsVerkoyen\VoipCenter\Tests;

use TijsVerkoyen\VoipCenter\VoipCenter;

class VoipCenterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var VoipCenter
     */
    private $voipCenter;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->voipCenter = new VoipCenter();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->voipCenter = null;
        parent::tearDown();
    }

    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $this->voipCenter->setTimeout(42);
        $this->assertEquals(42, $this->voipCenter->getTimeout());

        $this->voipCenter->setUserAgent('testing/1.0.0');
        $this->assertEquals(
            'PHP VoipCenter/' . VoipCenter::VERSION . ' testing/1.0.0',
            $this->voipCenter->getUserAgent()
        );
    }
}
