<?php

namespace App\Application\APIs\Events;

class Events
{
    const TOKEN_EXPIRED = 'personal_authentication.token_expired';
    const TOKEN_INVALID = 'personal_authentication.token_invalid';
    const NO_TOKEN = 'personal_authentication.no_token';
}
