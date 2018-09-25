<?php

namespace App\Application\APIs\Users\All\Handlers;

use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Users\All\Handlers\Interfaces\HandlerUsersInterface;
use App\Application\APIs\Users\All\InputFilters\UserInputFilters;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerUsersInterface
{
    /**
     * @param Request $request
     *
     * @return InputFiltersInterface
     */
    public function handle(Request $request): InputFiltersInterface
    {
        return new UserInputFilters(
            $request->attributes->get('client'),
            ($request->query->get('limit'))? : null,
            ($request->query->get('offset'))? : null
        );
    }
}
