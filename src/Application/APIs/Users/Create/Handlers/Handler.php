<?php

namespace App\Application\APIs\Users\Create\Handlers;

use App\Application\APIs\Users\Create\Handlers\Interfaces\NewUserHandlerInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;
use App\Application\APIs\Users\Create\InputItems\UserInputItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class Handler implements NewUserHandlerInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Handler constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     *
     * @return UserInputItemInterface|object
     */
    public function handle(Request $request): UserInputItemInterface
    {
        /** @var UserInputItemInterface $client */
        $client = $this->serializer->deserialize(
            $request->getContent(),
            UserInputItem::class,
            'json'
        );

        $client->addClientId(
            $request->attributes->get('client')
        );

        return $client;
    }
}
