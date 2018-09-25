<?php

namespace App\Application\APIs\Users\All\Handlers\Interfaces;

use App\Application\APIs\Interfaces\HandlerInterface;
use App\Application\APIs\Interfaces\InputFiltersInterface;
use Symfony\Component\HttpFoundation\Request;

interface HandlerUsersInterface extends HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return InputFiltersInterface
     */
    public function handle(Request $request): InputFiltersInterface;
}
