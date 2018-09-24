<?php

namespace App\Application\APIs\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     *
     * @return InputInterface
     */
    public function handle(Request $request): InputInterface;
}
