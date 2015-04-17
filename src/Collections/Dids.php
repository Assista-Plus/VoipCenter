<?php

namespace TijsVerkoyen\VoipCenter\Collections;

class Dids extends Base implements BaseInterface
{
    /**
     * {@inheritdoc}
     */
    public function getItemClass()
    {
        return '\TijsVerkoyen\\VoipCenter\\Objects\\Did';
    }
}
