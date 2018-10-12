<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Interfaces\UserInterface;
use App\Domain\Models\User;
use App\Domain\Repositories\Interfaces\RepositoryCacheInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserRepository extends ServiceEntityRepository implements RepositoryCacheInterface
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
        return $this->_em->createQuery("SELECT u FROM App\Domain\Models\User u JOIN u.client c WHERE c.id = :clientId")
                         ->setParameter('clientId', $id)
                         ->useResultCache(true)
                         ->setResultCacheLifetime(self::TTL)
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
        return $this->_em->createQuery("SELECT u FROM App\Domain\Models\User u JOIN u.client c WHERE c.id = :clientId AND u.id = :userId")
            ->setParameters(['userId' => $userId, 'clientId' => $clientId])
            ->useResultCache(true)
            ->setResultCacheLifetime(self::TTL)
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
