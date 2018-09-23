<?php

namespace App\UI\Responders\Interfaces;

use App\Application\APIs\Interfaces\OutputItemInterface;
use Symfony\Component\HttpFoundation\Response;

interface OutputJSONResponderInterface
{
    const CONTENT_TYPE = ['content-type' => 'application/json'];

    /**
     * @param OutputItemInterface|null $content
     * @param int|null $statusCode
     * @param array|null $headers
     *
     * @return mixed
     */
    public function response(
        ?OutputItemInterface $content = null,
        ?int $statusCode = Response::HTTP_OK,
        ?array $headers = null
    );
}
