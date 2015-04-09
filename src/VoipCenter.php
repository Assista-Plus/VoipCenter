<?php
namespace TijsVerkoyen\VoipCenter;

/**
 * VoipCenter class
 *
 * @author    Tijs Verkoyen <php-voipcenter@verkoyen.eu>
 * @version   2.0.0
 * @copyright Copyright (c), Tijs Verkoyen. All rights reserved.
 * @license   BSD License
 */
class VoipCenter
{
    const VERSION = "1.0.0";
    const DEBUG = false;

    /**
     * The user agent
     *
     * @var string
     */
    private $userAgent;

    /**
     * The timeout
     *
     * @var int
     */
    private $timeout = 30;

    public function __construct()
    {
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Get the useragent that will be used.
     * Our version will be prepended to yours.
     * It will look like: "PHP VoipCenter/<version> <your-user-agent>"
     *
     * @return string
     */
    public function getUserAgent()
    {
        return (string) 'PHP VoipCenter/' . self::VERSION . ' ' . $this->userAgent;
    }

    /**
     * Set the user-agent for you application
     * It will be appended to ours, the result will look like: "PHP VoipCenter/<version> <your-user-agent>"
     *
     * @param string $userAgent Your user-agent, it should look like <app-name>/<app-version>.
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string) $userAgent;
    }

    /**
     * Make a call
     */
    protected function doCall()
    {
    }
}
