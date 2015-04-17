<?php

namespace TijsVerkoyen\VoipCenter\Objects;

class Did implements BaseInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $number;

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
     * @return Did
     */
    public function setId($id)
    {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Did
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function fromAPI($data)
    {
        $this->setNumber($data);

        return $this;
    }
}
