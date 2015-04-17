<?php

namespace TijsVerkoyen\VoipCenter\Tests\Objects;

use TijsVerkoyen\VoipCenter\Objects\Did;

class DidTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Did
     */
    protected $did;

    public function setUp()
    {
        $this->did = new Did();
    }

    public function tearDown()
    {
        $this->did = null;
    }

    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $this->did->setId(1337);
        $this->assertEquals(1337, $this->did->getId());
        $this->did->setNumber('0123456789');
        $this->assertEquals('0123456789', $this->did->getNumber());
    }

    public function testValidFromApiMinimalObject()
    {
        $expectedDid = new Did();
        $expectedDid->setNumber('0123456789');

        $this->assertEquals(
            $expectedDid,
            $this->did->fromAPI('0123456789')
        );
    }
}
