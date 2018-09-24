<?php

namespace App\Application\APIs\Users\All\Handlers;

use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Users\All\Handlers\Interfaces\HandlerUsersInterface;
use App\Application\APIs\Users\All\InputItems\UserInput;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerUsersInterface
{
    /**
     * @param Request $request
     *
     * @return InputInterface
     */
    public function handle(Request $request): InputInterface
    {
        return new UserInput(
            $request->attributes->get('client'),
            ($request->query->get('limit'))? : null,
            ($request->query->get('offset'))? : null
        );
    }
}
