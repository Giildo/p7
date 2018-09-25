<?php

namespace App\Application\APIs\Users\Show\Handlers;

use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Users\Show\Handlers\Interfaces\HandlerUserInterface;
use App\Application\APIs\Users\Show\InputFilters\OneUserInputFilters;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerUserInterface
{
    /**
     * @param Request $request
     *
     * @return InputFiltersInterface
     */
    public function handle(Request $request): InputFiltersInterface
    {
        return new OneUserInputFilters(
            $request->attributes->get('id'),
            $request->attributes->get('client')
        );
    }
}
