<?php

namespace App\Application\APIs\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     */
    public function handle(Request $request);
}
