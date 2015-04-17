<?php

namespace TijsVerkoyen\VoipCenter\Tests\Objects;

use TijsVerkoyen\VoipCenter\Objects\SipAccount;

class SipAccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SipAccount
     */
    protected $sipAccount;

    public function setUp()
    {
        $this->sipAccount = new SipAccount();
    }

    public function tearDown()
    {
        $this->sipAccount = null;
    }

    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $this->sipAccount->setDidOut('didOut');
        $this->assertEquals('didOut', $this->sipAccount->getDidOut());
        $this->sipAccount->setFirstName('firstName');
        $this->assertEquals('firstName', $this->sipAccount->getFirstName());
        $this->sipAccount->setId(1337);
        $this->assertEquals(1337, $this->sipAccount->getId());
        $this->sipAccount->setLogName('logName');
        $this->assertEquals('logName', $this->sipAccount->getLogName());
        $this->sipAccount->setName('name');
        $this->assertEquals('name', $this->sipAccount->getName());
        $this->sipAccount->setSipPing(1);
        $this->assertEquals(1, $this->sipAccount->getSipPing());
        $this->sipAccount->setSipUsername('username');
        $this->assertEquals('username', $this->sipAccount->getSipUsername());
        $this->sipAccount->setUserAgent('userAgent');
        $this->assertEquals('userAgent', $this->sipAccount->getUserAgent());
    }

    public function testValidFromApiFullObject()
    {
        $expectedSipAccount = new SipAccount();
        $expectedSipAccount
            ->setLogName('John')
            ->setName('Doe')
            ->setFirstName('John')
            ->setDidOut('3212345678')
            ->setSipUsername('username0')
            ->setUserAgent('Vendor/Type/Version')
            ->setSipPing(25);

        $this->assertEquals(
            $expectedSipAccount,
            $this->sipAccount->fromAPI(
                array(
                    'logname' => $expectedSipAccount->getLogName(),
                    'naam' => $expectedSipAccount->getName(),
                    'voornaam' => $expectedSipAccount->getFirstName(),
                    'DIDout' => $expectedSipAccount->getDidOut(),
                    'SIPusername' => $expectedSipAccount->getSipUsername(),
                    'userAgent' => $expectedSipAccount->getUserAgent(),
                    'SIPping' => $expectedSipAccount->getSipPing(),
                )
            )
        );
    }

    public function testValidFromApiMinimalObject()
    {
        $expectedSipAccount = new SipAccount();
        $expectedSipAccount
            ->setId(1)
            ->setLogName('John')
            ->setSipUsername('username0');

        $this->assertEquals(
            $expectedSipAccount,
            $this->sipAccount->fromAPI(
                array(
                    'id' => '1',
                    'logname' => $expectedSipAccount->getLogName(),
                    'SIPusername' => $expectedSipAccount->getSipUsername(),
                )
            )
        );
    }
}
