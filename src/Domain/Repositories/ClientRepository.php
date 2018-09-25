<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Client;
use App\Domain\Models\Interfaces\ClientInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

class ClientRepository extends ServiceEntityRepository
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
        return $this->createQueryBuilder('client')
            ->where('client.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
