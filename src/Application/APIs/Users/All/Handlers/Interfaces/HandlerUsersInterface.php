<?php

namespace App\Application\APIs\Users\All\Handlers\Interfaces;

use App\Application\APIs\Interfaces\HandlerInterface;
use App\Application\APIs\Interfaces\InputInterface;
use Symfony\Component\HttpFoundation\Request;

interface HandlerUsersInterface extends HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return InputInterface
     */
    public function handle(Request $request): InputInterface;
}
