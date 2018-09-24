<?php

namespace App\Application\APIs\Phones\All\Handlers;

use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Phones\All\Handlers\Interfaces\HandlerPhonesInterface;
use App\Application\APIs\Phones\All\InputItems\PhoneInput;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerPhonesInterface
{
    /**
     * @param Request $request
     * @param array|null $params
     *
     * @return InputInterface
     */
    public function handle(Request $request, ?array $params = []): InputInterface
    {
        return new PhoneInput(
            (int)$request->query->get('limit') ?? null,
            (int)$request->query->get('offset') ?? null,
            $request->query->get($params['category']) ?? null
        );
    }
}
