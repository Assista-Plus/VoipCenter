<?php

namespace TijsVerkoyen\VoipCenter\Tests\Collections;

use TijsVerkoyen\VoipCenter\Collections\Dids;

class DidsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dids
     */
    protected $dids;

    public function setUp()
    {
        $this->dids = new Dids();
    }

    public function tearDown()
    {
        $this->dids = null;
    }

    public function testGetItemClass()
    {
        $this->assertEquals(
            '\TijsVerkoyen\\VoipCenter\\Objects\\Did',
            $this->dids->getItemClass()
        );
    }

    public function testValidFromApi()
    {
        $response = $this->dids->fromAPI(
            array(
                'id_1' => '0123456789',
                'id_2' => '0123456789',
            )
        );

        foreach ($response as $row) {
            $this->assertInstanceOf('\TijsVerkoyen\VoipCenter\Objects\Did', $row);
        }
    }
}
