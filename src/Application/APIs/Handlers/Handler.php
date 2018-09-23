<?php

namespace App\Application\APIs\Handlers;

use App\Application\APIs\Interfaces\HandlerInterface;
use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Phones\All\InputItems\PhoneInput;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerInterface
{

    /**
     * @param Request $request
     * @param string $category
     *
     * @return InputInterface
     */
    public function handle(Request $request, string $category): InputInterface
    {
        return new PhoneInput(
            (int)$request->query->get('limit') ?? null,
            (int)$request->query->get('offset') ?? null,
            $request->query->get($category) ?? null
        );
    }
}
