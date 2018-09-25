<?php

namespace App\Application\APIs\Users\Create\Handlers\Interfaces;

use App\Application\APIs\Interfaces\HandlerInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;
use Symfony\Component\HttpFoundation\Request;

interface NewUserHandlerInterface extends HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return UserInputItemInterface
     */
    public function handle(Request $request): UserInputItemInterface;
}
