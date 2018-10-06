<?php

namespace App\Application\APIs\Helpers\Builders;

use App\Application\APIs\Helpers\Builders\Interfaces\UserBuilderInterface;
use App\Application\APIs\Interfaces\InputItemInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserBuilder implements UserBuilderInterface
{
    /**
     * @var UserInterface
     */
    private $user;
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * UserBuilder constructor.
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param UserInputItemInterface|InputItemInterface $inputItem
     * @param ClientInterface $client
     *
     * @return UserBuilderInterface
     */
    public function build(InputItemInterface $inputItem, ClientInterface $client): UserBuilderInterface
    {
        $this->user = new User(
            $inputItem->getUsername(),
            $this->encoderFactory->getEncoder(User::class)->encodePassword($inputItem->getPassword(), ''),
            $inputItem->getRoles(),
            $client
        );

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getEntity(): UserInterface
    {
        return $this->user;
    }
}
