<?php

namespace Erp\Bundle\CoreBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Erp\Bundle\CoreBundle\Repository\UpdatableRepositoryInterface;

/**
 * Erp repository Interface
 */
interface ErpRepositoryInterface extends ObjectRepository, UpdatableRepositoryInterface{
}
