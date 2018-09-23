<?php

namespace App\UI\Responders;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class OutputJSONResponder implements OutputJSONResponderInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * OutputJSONResponder constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

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
    ) {
        return new Response(
            $content ? $this->serializer->serialize($content, 'json') : null,
            $statusCode,
            $headers ? : self::CONTENT_TYPE
        );
    }
}
