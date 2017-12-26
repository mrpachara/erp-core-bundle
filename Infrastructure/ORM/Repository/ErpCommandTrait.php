<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Erp\Bundle\CoreBundle\Domain\Exception\OperatorNotAllowedException;
use Erp\Bundle\CoreBundle\Entity\Thing;
use Erp\Bundle\CoreBundle\Entity\StatusPresentable;

/**
 * Trait Erp Repository (ORM) Command Only
 */
trait ErpCommandTrait{
  // Command (CQRS)

  /**
   * {@inheritDoc}
   */
  public function create(Thing $dummy = null){
    $className = $this->getClassName();

    return new $className();
  }

  /**
   * {@inheritDoc}
   */
  public function beginTransaction() {
    $em = $this->getEntityManager();

    $em->beginTransaction();
  }

  /**
   * {@inheritDoc}
   */
  public function transactional($func) {
    $em = $this->getEntityManager();

    return $em->transactional($func);
  }

  /**
   * {@inheritDoc}
   */
  public function commit() {
    $em = $this->getEntityManager();

    return $em->commit();
  }

  /**
   * {@inheritDoc}
   */
  public function rollback() {
    $em = $this->getEntityManager();

    return $em->rollback();
  }


  /**
   * {@inheritDoc}
   */
  public function persist($entity){
    if(($entity instanceof StatusPresentable) && !$entity->updatable())
      throw new OperatorNotAllowedException('Item cannot be updated.');

    $em = $this->getEntityManager();

    $em->persist($entity);
    //$em->flush($entity); // deprecate: it doesn't cassade flush on persisting
    //$em->flush();
    //$em->refresh($entity);
  }

  /**
   * {@inheritDoc}
   */
  public function remove($entity){
    if(($entity instanceof StatusPresentable) && !$entity->deletable())
      throw new OperatorNotAllowedException('Item cannot be deleted.');

    $em = $this->getEntityManager();

    $em->remove($entity);
    //$em->flush($entity);
  }

  /**
   * {@inheritDoc}
   */
  public function flush(){
    $em = $this->getEntityManager();

    $em->flush();
  }
}
