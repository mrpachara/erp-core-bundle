<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Doctrine\ORM\EntityRepository;
use Erp\Bundle\CoreBundle\Domain\CQRS\ErpQuery as QueryInterface;
use Erp\Bundle\CoreBundle\Domain\CQRS\ErpCommand as CommandInterface;

/**
 * Erp Repository (ORM)
 */
class ErpRepository extends EntityRepository implements
  QueryInterface, CommandInterface{
  use ErpQueryTrait;
  use ErpCommandTrait;

  function getEm() {
    return $this->getEntityManager();
  }
}
