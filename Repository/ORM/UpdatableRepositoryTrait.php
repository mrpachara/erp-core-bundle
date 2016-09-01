<?php

namespace Erp\Bundle\CoreBundle\Repository\ORM;

use Doctrine\ORM\EntityManager;

/**
 */
trait UpdatableRepositoryTrait{
    /**
     * @return EntityManager
     */
    abstract protected function getEntityManager();

    /**
     * @inheritDoc
     */
    public function save($entity){
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush();
    }

    /**
     * @inheritDoc
     */
    public function remove($entity){
        $em = $this->getEntityManager();

        $em->remove($entity);
        $em->flush();
    }
}
