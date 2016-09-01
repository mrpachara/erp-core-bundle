<?php

namespace Erp\Bundle\CoreBundle\Service\Impl;

use Erp\Bundle\CoreBundle\Model\ThingInterface;
use Erp\Bundle\CoreBundle\Repository\CoreAccountRepositoryInterface;

use Erp\Bundle\CoreBundle\Service\ErpRepositoryServiceTrait;
use Erp\Bundle\CoreBundle\Service\CoreAccountServiceInterface;

/**
 * Core account Service
 */
class CoreAccountService implements CoreAccountServiceInterface{
    use ErpRepositoryServiceTrait;

    /**
     * @var CoreAccountRepositoryInterface
     */
    protected $repository;

    /**
     * Class constructor
     *
     * @param CoreAccountRepositoryInterface $repository
     */
    public function __construct(CoreAccountRepositoryInterface $repository){
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function findThing(ThingInterface $thing){
        return $this->getRepository()->findThing($thing);
    }
}
