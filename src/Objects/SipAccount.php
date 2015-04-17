<?php

namespace TijsVerkoyen\VoipCenter\Objects;

class SipAccount extends Base implements BaseInterface
{
    /**
     * Mapping for the fields in the API and the properties of our objects
     *
     * @var array
     */
    protected $mapping = array(
        'logname' => 'logName',
        'naam' => 'name',
        'voornaam' => 'firstName',
        'DIDout' => 'didOut',
        'SIPusername' => 'sipUsername',
        'userAgent' => 'userAgent',
        'SIPping' => 'sipPing'
    );

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $logName;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $didOut;

    /**
     * @var string
     */
    protected $sipUsername;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var int
     */
    protected $sipPing;

    /**
     * @return array
     */
    protected function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     * @return SipAccount
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Get logName
     *
     * @return string
     */
    public function getLogName()
    {
        return $this->logName;
    }

    /**
     * Set logName
     *
     * @param string $logName
     * @return SipAccount
     */
    public function setLogName($logName)
    {
        $this->logName = $logName;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SipAccount
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return SipAccount
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get didOut
     *
     * @return string
     */
    public function getDidOut()
    {
        return $this->didOut;
    }

    /**
     * Set didOut
     *
     * @param string $didOut
     * @return SipAccount
     */
    public function setDidOut($didOut)
    {
        $this->didOut = $didOut;

        return $this;
    }

    /**
     * Get sipUsername
     *
     * @return string
     */
    public function getSipUsername()
    {
        return $this->sipUsername;
    }

    /**
     * Set sipUsername
     *
     * @param string $sipUsername
     * @return SipAccount
     */
    public function setSipUsername($sipUsername)
    {
        $this->sipUsername = $sipUsername;

        return $this;
    }

    /**
     * Get userAgent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * Set userAgent
     *
     * @param string $userAgent
     * @return SipAccount
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Get sipPing
     *
     * @return int
     */
    public function getSipPing()
    {
        return $this->sipPing;
    }

    /**
     * Set sipPing
     *
     * @param int $sipPing
     * @return SipAccount
     */
    public function setSipPing($sipPing)
    {
        $this->sipPing = (int) $sipPing;

        return $this;
    }
}
