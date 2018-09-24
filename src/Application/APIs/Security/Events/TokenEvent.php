<?php

namespace App\Application\APIs\Security\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;

class TokenEvent extends AuthenticationFailureEvent
{
}
