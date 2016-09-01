<?php

namespace Erp\Bundle\CoreBundle\Repository;

/**
 * Updateable Repository Interface
 */
interface UpdatableRepositoryInterface{
    /**
     * Save (create/update) Entity
     *
     * @param mixed $entity
     */
    public function save($entity);

    /**
    * Remove Entity
    *
    * @param mixed $entity
     */
    public function remove($entity);
}
