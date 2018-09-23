<?php

namespace App\Application\APIs\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface HandlerInterface
{
    /**
     * @param Request $request
     * @param string $category
     *
     * @return InputInterface
     */
    public function handle(Request $request, string $category): InputInterface;
}
