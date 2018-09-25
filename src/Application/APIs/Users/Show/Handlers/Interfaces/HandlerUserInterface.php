<?php

namespace App\Application\APIs\Users\Show\Handlers\Interfaces;

use App\Application\APIs\Interfaces\HandlerInterface;
use App\Application\APIs\Interfaces\InputFiltersInterface;
use Symfony\Component\HttpFoundation\Request;

interface HandlerUserInterface extends HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return InputFiltersInterface
     */
    public function handle(Request $request): InputFiltersInterface;
}
