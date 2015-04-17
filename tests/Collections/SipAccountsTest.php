<?php

namespace TijsVerkoyen\VoipCenter\Tests\Collections;

use TijsVerkoyen\VoipCenter\Collections\SipAccounts;

class SipAccountsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SipAccounts
     */
    protected $sipAccounts;

    public function setUp()
    {
        $this->sipAccounts = new SipAccounts();
    }

    public function tearDown()
    {
        $this->sipAccounts = null;
    }

    public function testGetItemClass()
    {
        $this->assertEquals(
            '\TijsVerkoyen\\VoipCenter\\Objects\\SipAccount',
            $this->sipAccounts->getItemClass()
        );
    }

    public function testValidFromApi()
    {
        $response = $this->sipAccounts->fromAPI(
            array(
                'id_1' => array(
                    'logname' => 'John Doe',
                    'SIPusername' => 'username0',
                ),
                'id_2' => array(
                    'logname' => 'Foo Bar',
                    'SIPusername' => 'username0',
                ),
            )
        );

        foreach ($response as $row) {
            $this->assertInstanceOf('\TijsVerkoyen\VoipCenter\Objects\SipAccount', $row);
        }
    }
}
