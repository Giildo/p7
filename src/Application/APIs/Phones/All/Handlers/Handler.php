<?php

namespace App\Application\APIs\Phones\All\Handlers;

use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Phones\All\Handlers\Interfaces\HandlerPhonesInterface;
use App\Application\APIs\Phones\All\InputFilters\PhoneInputFilters;
use Symfony\Component\HttpFoundation\Request;

class Handler implements HandlerPhonesInterface
{
    /**
     * @param Request $request
     * @param array|null $params
     *
     * @return InputFiltersInterface
     */
    public function handle(Request $request, ?array $params = []): InputFiltersInterface
    {
        return new PhoneInputFilters(
            (int)$request->query->get('limit') ?? null,
            (int)$request->query->get('offset') ?? null,
            $request->query->get($params['category']) ?? null
        );
    }
}
