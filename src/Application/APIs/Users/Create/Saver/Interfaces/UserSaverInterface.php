<?php

namespace App\Application\APIs\Users\Create\Saver\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;

interface UserSaverInterface
{
    /**
     * @param UserInputItemInterface $inputItem
     *
     * @return OutputItemInterface
     */
    public function save(UserInputItemInterface $inputItem): OutputItemInterface;
}
