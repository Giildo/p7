<?php

namespace App\Application\APIs\Users\Create\Saver;

use App\Application\APIs\Helpers\Builders\Interfaces\UserBuilderInterface;
use App\Application\APIs\Helpers\Hateoas\HateoasBuilder;
use App\Application\APIs\Helpers\Hateoas\LinkFactory;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Users\Create\InputItems\Interfaces\UserInputItemInterface;
use App\Application\APIs\Users\Create\Saver\Interfaces\UserSaverInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;
use App\Domain\Repositories\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class Saver implements UserSaverInterface
{
    /**
     * @var HateoasBuilder
     */
    private $hateoasBuilder;
    /**
     * @var UserBuilderInterface
     */
    private $userBuilder;
    /**
     * @var ClientRepository
     */
    private $clientRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * Saver constructor.
     * @param HateoasBuilder $hateoasBuilder
     * @param UserBuilderInterface $userBuilder
     * @param ClientRepository $clientRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        HateoasBuilder $hateoasBuilder,
        UserBuilderInterface $userBuilder,
        ClientRepository $clientRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->hateoasBuilder = $hateoasBuilder;
        $this->userBuilder = $userBuilder;
        $this->clientRepository = $clientRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param UserInputItemInterface $inputItem
     *
     * @return OutputItemInterface
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(UserInputItemInterface $inputItem): OutputItemInterface
    {
        $client = $this->clientRepository->loadOneClientById($inputItem->getClientId());

        $user = $this->userBuilder->build($inputItem, $client)
                                  ->getEntity();

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new UserOutput(
            $user,
            [
                $this->hateoasBuilder->build(
                    LinkFactory::GET_SHOW,
                    'User_show',
                    [
                        'client' => $inputItem->getClientId(),
                        'id'     => $user->getId()
                    ]
                ),
                $this->hateoasBuilder->build(
                    LinkFactory::DELETE_SHOW,
                    'User_delete',
                    [
                        'client' => $inputItem->getClientId(),
                        'id'     => $user->getId()
                    ]
                ),
                $this->hateoasBuilder->build(
                    LinkFactory::GET_LIST,
                    'Users_list',
                    ['client' => $inputItem->getClientId()]
                )
            ]
        );
    }
}
