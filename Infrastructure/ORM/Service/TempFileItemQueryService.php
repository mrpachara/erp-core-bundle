<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Erp\Bundle\CoreBundle\Domain\CQRS\TempFileItemQuery as QueryInterface;
use Doctrine\ORM\EntityRepository;

class TempFileItemQueryService implements QueryInterface
{
    /** @var EntityRepository */
    protected $repository;

    /** @required */
    public function setRepository(\Symfony\Bridge\Doctrine\RegistryInterface $doctrine)
    {
        $this->repository = $doctrine->getRepository('ErpCoreBundle:TempFileItem');
    }

    /** {@inheritDoc} */
    public function get(string $uuid)
    {
        return $this->repository->find($uuid);
    }
}
