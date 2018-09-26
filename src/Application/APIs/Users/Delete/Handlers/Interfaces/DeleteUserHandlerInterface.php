<?php

namespace App\Application\APIs\Users\Delete\Handlers\Interfaces;

use App\Application\APIs\Interfaces\HandlerInterface;
use Symfony\Component\HttpFoundation\Request;

interface DeleteUserHandlerInterface extends HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function handle(Request $request): void;
}
