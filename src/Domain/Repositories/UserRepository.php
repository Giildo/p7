<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $id
     *
     * @return User[]|array
     */
    public function loadUsersByClientId(string $id): array
    {
        return $this->createQueryBuilder('user')
            ->innerJoin('user.client', 'client')
            ->where('client.id = :clientId')
            ->setParameter('clientId', $id)
            ->addSelect('client')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $userId
     * @param string $clientId
     *
     * @return User|null
     *
     * @throws NonUniqueResultException
     */
    public function loadOneUserByClientUsernameAndUserId(string $userId, string $clientId): ?User
    {
        return $this->createQueryBuilder('user')
            ->innerJoin('user.client', 'client')
            ->where('client.id = :clientId')
            ->andWhere('user.id = :userId')
            ->setParameters(['userId' => $userId, 'clientId' => $clientId])
            ->addSelect('client')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param UserInterface $user
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveUser(UserInterface $user): void
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param UserInterface $user
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteUser(UserInterface $user): void
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }
}
