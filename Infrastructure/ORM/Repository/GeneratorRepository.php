<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Doctrine\ORM;

use Doctrine\DBAL;

/**
 * generator repository (ORM)
 */
class GeneratorRepository extends ORM\EntityRepository
{
    /**
     * get generator
     *
     * @param string $code
     *
     * @return Generator
     */
    public function generator(string $code)
    {
        $qb = $this->createQueryBuilder('_generator')
            ->where('_generator.code = :code')
            ->setParameter('code', $code)
        ;
        $query = $qb->getQuery();
        $query->setLockMode(DBAL\LockMode::PESSIMISTIC_WRITE);

        return $query->getSingleResult();
    }
}
