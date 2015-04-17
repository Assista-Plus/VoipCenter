<?php

namespace TijsVerkoyen\VoipCenter\Collections;

interface BaseInterface
{
    /**
     * @return string
     */
    public function getItemClass();

    /**
     * Convert a response from the API into an object
     *
     * @param array $data
     * @return Base $this
     */
    public function fromAPI($data);
}
