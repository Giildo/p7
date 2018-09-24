<?php

namespace App\Application\APIs\Users\Show\Handlers;

use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Users\Show\Handlers\Interfaces\HandlerUserInterface;
use App\Application\APIs\Users\Show\InputItems\UserInput;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerUserInterface
{
    /**
     * @param Request $request
     *
     * @return InputInterface
     */
    public function handle(Request $request): InputInterface
    {
        return new UserInput(
            $request->attributes->get('id'),
            $request->attributes->get('client')
        );
    }
}
