<?php

namespace Erp\Bundle\CoreBundle\Service;

use Erp\Bundle\CoreBundle\Repository\ErpRepositoryInterface;
use Erp\Bundle\CoreBundle\Model\ThingInterface;

/**
 * ERP repository based Service Trait
 */
trait ErpRepositoryServiceTrait{
    /**
     * Domain-driven Repository
     *
     * @return ErpRepositoryInterface
     */
    protected function getRepository(){
        return $this->repository;
    }

    /**
     * @inheritDoc
     */
    public function find($id){
        return $this->getRepository()->find($id);
    }

    /**
     * @inheritDoc
     */
    public function findAll(){
        return $this->getRepository()->findAll();
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null){
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOneBy(array $criteria){
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * @inheritDoc
     */
    public function getClassName(){
        return $this->getRepository()->getClassName();
    }

    /**
     * @inheritDoc
     */
    public function save($entity){
        return $this->getRepository()->save($entity);
    }

    /**
     * @inheritDoc
     */
    public function remove($entity){
        return $this->getRepository()->remove($entity);
    }

    /**
     * @inheritDoc
     */
    public function thing(ThingInterface $thing){
        return $this->getRepository()->thing($entity);
    }
}
