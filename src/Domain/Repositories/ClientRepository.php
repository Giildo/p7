<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Client;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Repositories\Interfaces\RepositoryCacheInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

class ClientRepository extends ServiceEntityRepository implements RepositoryCacheInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param string $id
     *
     * @return ClientInterface
     *
     * @throws NonUniqueResultException
     */
    public function loadOneClientById(string $id): ClientInterface
    {
        return $this->_em->createQuery("SELECT c FROM App\Domain\Models\Client c WHERE c.id = :id")
                         ->setParameter('id', $id)
                         ->useResultCache(true)
                         ->setResultCacheLifetime(self::TTL)
                         ->getOneOrNullResult();
    }
}
