<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
}
