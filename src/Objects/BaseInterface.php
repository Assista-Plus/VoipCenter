<?php

namespace TijsVerkoyen\VoipCenter\Objects;

interface BaseInterface
{
    /**
     * Convert a response from the API into an object
     *
     * @param array $data
     * @return Base $this
     */
    public function fromAPI($data);
}
