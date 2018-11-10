<?php

namespace App\Application\APIs\Users\Delete\Handlers;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Users\Delete\Handlers\Interfaces\DeleteUserHandlerInterface;
use App\Domain\Repositories\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

class DeleteUserHandler implements DeleteUserHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * DeleteUserHandler constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return void
     *
     * @throws ItemNotFoundException
     * @throws NonUniqueResultException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function handle(Request $request): void
    {
        $user = $this->userRepository->loadOneUserByClientIdAndUserId(
            $request->attributes->get('id'),
            $request->attributes->get('client')
        );

        if (is_null($user)) {
            throw new ItemNotFoundException(ItemNotFoundException::USER_NOT_FOUND);
        }

        $this->userRepository->deleteUser($user);
    }
}
