<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $username
     *
     * @return User[]|array
     */
    public function loadUserByClientUsername(string $username): array
    {
        return $this->createQueryBuilder('user')
            ->innerJoin('user.client', 'client')
            ->where('client.username = :username')
            ->setParameter('username', $username)
            ->addSelect('client')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $id
     * @param string $username
     *
     * @return User|null
     *
     * @throws NonUniqueResultException
     */
    public function loadOneUserByClientUsernameAndUserId(string $id, string $username): ?User
    {
        return $this->createQueryBuilder('user')
            ->innerJoin('user.client', 'client')
            ->where('client.username = :username')
            ->andWhere('user.id = :id')
            ->setParameters(['id' => $id, 'username' => $username])
            ->addSelect('client')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
