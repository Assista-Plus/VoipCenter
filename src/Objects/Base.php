<?php

namespace TijsVerkoyen\VoipCenter\Objects;

class Base
{
    /**
     * @var array
     */
    protected $mapping = array();

    /**
     * {@inheritdoc}
     */
    public function fromAPI($data)
    {
        foreach ($data as $key => $value) {
            $propertyName = $key;

            if (isset($this->mapping[$key])) {
                $propertyName = $this->mapping[$key];
            }

            $method = array(
                $this,
                'set' . ucfirst($propertyName),
            );

            if (is_callable($method)) {
                call_user_func($method, $value);
            }
        }

        return $this;
    }
}
