<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;

class JWTEncodedListener
{
    /**
     * @param $event
     * @return string
     */
    public function onJwtEncoded($event)
    {
        return $event->getJWTString();
    }
}