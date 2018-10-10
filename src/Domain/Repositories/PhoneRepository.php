<?php

namespace App\Domain\Repositories;

use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Phones\All\InputFilters\Interfaces\InputFiltersPhoneInterface;
use App\Domain\Models\Interfaces\PhoneInterface;
use App\Domain\Models\Phone;
use App\Domain\Repositories\Interfaces\RepositoryCacheInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

class PhoneRepository extends ServiceEntityRepository implements RepositoryCacheInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Phone::class);
    }

    /**
     * @param InputFiltersPhoneInterface|InputFiltersInterface|null $inputFilters
     *
     * @return PhoneInterface[]
     */
    public function loadPhonesWithFilters(?InputFiltersInterface $inputFilters = null): array
    {
        $qb =  $this->_em->createQuery('SELECT p FROM App\Domain\Models\Phone p');

        if (!is_null($inputFilters->getCategory())) {
            $qb = $this->_em->createQuery('SELECT p FROM App\Domain\Models\Phone p JOIN p.brand b WHERE b.id = :id');
        }

        if ($inputFilters->getLimit() !== 0) {
            $qb->setMaxResults($inputFilters->getLimit());
        }

        if ($inputFilters->getOffset() !== 0) {
            $qb->setFirstResult($inputFilters->getOffset());
        }

        if (!is_null($inputFilters->getCategory())) {
            return $qb->useResultCache(true)
                ->setResultCacheLifetime(self::TTL)
                ->execute(['id' => $inputFilters->getCategory()]);
        }

        return $qb->useResultCache(true)
            ->setResultCacheLifetime(self::TTL)
            ->getResult();
    }

    /**
     * @param string $id
     *
     * @return PhoneInterface|null
     *
     * @throws NonUniqueResultException
     */
    public function loadOnePhoneById(string $id): ?PhoneInterface
    {
        return $this->_em->createQuery("SELECT p FROM App\Domain\Models\Phone p WHERE p.id = :id")
            ->useResultCache(true)
            ->setResultCacheLifetime(self::TTL)
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }
}
