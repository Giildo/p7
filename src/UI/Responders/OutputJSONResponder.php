<?php

namespace App\UI\Responders;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param int|null $statusCode
     * @param array|null $headers
     *
     * @return mixed
     */
    public function response(
        ?OutputItemInterface $content = null,
        ?Request $request = null,
        ?int $statusCode = Response::HTTP_OK,
        ?array $headers = null
    ): Response {
        $response = new Response(
            $content ? $this->serializer->serialize($content, 'json') : null,
            $statusCode,
            $headers ?: self::CONTENT_TYPE
        );

        if (!is_null($request) && $request->isMethodCacheable()) {
            $response->setEtag(md5($response->getContent()));
            $response->setPublic();
            $response->isNotModified($request);
        }

        return $response;
    }
}
