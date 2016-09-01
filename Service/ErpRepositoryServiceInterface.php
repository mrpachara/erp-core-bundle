<?php

namespace Erp\Bundle\CoreBundle\Service;

use Doctrine\Common\Persistence\ObjectRepository;
use Erp\Bundle\CoreBundle\Repository\UpdatableRepositoryInterface;

/**
 * ERP repository based Service Interface
 */
interface ErpRepositoryServiceInterface extends ObjectRepository, UpdatableRepositoryInterface{
}
