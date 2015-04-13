<?php

namespace TijsVerkoyen\VoipCenter\Tests;

use TijsVerkoyen\VoipCenter\VoipCenter;

class VoipCenterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the getters and setters
     */
    public function testGettersAndSetters()
    {
        $voipCenter = new VoipCenter(
            'id',
            'key',
            'client_number',
            'password'
        );

        $voipCenter->setTimeout(42);
        $this->assertEquals(42, $voipCenter->getTimeout());

        $voipCenter->setUserAgent('testing/1.0.0');
        $this->assertEquals(
            'PHP VoipCenter/' . VoipCenter::VERSION . ' testing/1.0.0',
            $voipCenter->getUserAgent()
        );
    }

    public function testCall()
    {
        $voipCenter = $this->getMockBuilder('\\TijsVerkoyen\\VoipCenter\\VoipCenter')
            ->setConstructorArgs(array('id', 'key', 'client_number', 'password'))
            ->setMethods(array('doCall'))
            ->getMock();

        $voipCenter->expects($this->once())
            ->method('doCall')
            ->willReturn(
                json_decode(
                    '{"head":{"status":"1","error_number":"","error_message":""},"body":{"status":"1","error_number":"","error_message":""}}',
                    true
                )
            );

        $this->assertTrue(
            $voipCenter->call('sipaccount1', '093950251')
        );
    }
}
