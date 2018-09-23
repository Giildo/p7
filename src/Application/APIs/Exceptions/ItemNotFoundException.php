<?php

namespace App\Application\APIs\Exceptions;

use Exception;

class ItemNotFoundException extends Exception
{
    const PHONE_NOT_FOUND = 1;
    const PHONE_NOT_FOUND_WITH_PARAM = 2;
    const PHONE_NOT_FOUND_WITH_THIS_BRAND = 3;
    const PHONE_NOT_FOUND_WITH_THIS_ID = 4;

    public function __construct(int $code = 0)
    {
        parent::__construct($this->buildMessage($code), $code, null);
    }

    private function buildMessage(int $code): string
    {
        $message = '';

        switch ($code) {
            case self::PHONE_NOT_FOUND:
                $message = 'Aucun portable n\'a été trouvé dans la base de données.';
                break;

            case self::PHONE_NOT_FOUND_WITH_PARAM:
                $message = 'Aucun portable n\'a été trouvé dans la base de données avec ces paramètres.';
                break;

            case self::PHONE_NOT_FOUND_WITH_THIS_BRAND:
                $message = 'Aucun portable de cette marque n\'a été trouvé dans la base de données.';
                break;

            case self::PHONE_NOT_FOUND_WITH_THIS_ID:
                $message = 'Aucun portable n\'a été trouvé dans la base de données avec cet identifiant.';
                break;
        };

        return $message;
    }
}
