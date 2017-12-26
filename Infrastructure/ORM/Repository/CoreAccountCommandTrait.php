<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Erp\Bundle\CoreBundle\Entity\Thing;

/**
 * Trait Core Account Repository (ORM) Command Only
 */
trait CoreAccountCommandTrait{
  // Command (CQRS)

  /**
   * @inheritDoc
   */
  public function create(Thing $thing = null){
    $className = $this->getClassName();

    $entity = new $className($thing);
    $this->getEntityManager()->persist($entity);
    return $entity;
  }
}
