<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Doctrine\ORM\QueryBuilder;
use Erp\Bundle\CoreBundle\Entity\Thing;


/**
 * Trait Core account repository (ORM) Query Only
 */
trait CoreAccountQueryTrait{
  // Query (CQRS)

  /**
   * @inheritDoc
   */
  public function findThing(Thing $thing){
    return $this->findBy([
      'thing' => $thing->getId(),
    ]);
  }

  /**
   * Create search term QueryBuilder
   *
   * @param QueryBuilder $qb      previous query builder.
   * @param bool $active          active value.
   *
   * @return QueryBuilder
   */
  protected function activeQuery(QueryBuilder $qb, bool $active){
    if(!$this->isAliasExisted($qb, '_thing')) $qb->leftJoin('_entity.thing', '_thing');
    return $qb
      ->where('_thing.active = :active')
      ->setParameter('active', $active)
    ;
  }

  /**
   * Create search term QueryBuilder
   *
   * @param QueryBuilder $qb      previous query builder.
   * @param string $term          search term.
   *
   * @return QueryBuilder
   */
  protected function searchTermQuery(QueryBuilder $qb, string $term){
    if(!$this->isAliasExisted($qb, '_thing')) $qb->leftJoin('_entity.thing', '_thing');
    return $qb
      ->where('_entity.code LIKE :term')
        ->orWhere('_thing.name LIKE :term')
        ->orderBy('_entity.code', 'ASC')
      ->setParameter('term', '%'.$term.'%')
    ;
  }

  /**
   * @inheritDoc
   */
  protected function searchAssignQuery(array $params){
    $qb = parent::searchAssignQuery($params);

    if(array_key_exists('active', $params))
      $this->activeQuery($qb, $params['active']);

    if(array_key_exists('search', $params) && !empty($params['search']))
      $this->searchTermQuery($qb, $params['search']);

    return $qb;
  }
}
