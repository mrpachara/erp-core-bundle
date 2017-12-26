<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountQuery as QueryInterface;
use Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountCommand as CommandInterface;

/**
 * Core account repository (ORM)
 */
class CoreAccountRepository extends ErpRepository implements
  QueryInterface, CommandInterface{
  use CoreAccountQueryTrait;
  use CoreAccountCommandTrait;
}
