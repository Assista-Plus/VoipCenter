<?php

namespace TijsVerkoyen\VoipCenter\Collections;

class SipAccounts extends Base implements BaseInterface
{
    /**
     * {@inheritdoc}
     */
    public function getItemClass()
    {
        return '\TijsVerkoyen\\VoipCenter\\Objects\\SipAccount';
    }
}
