<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * Trait Erp Repository (ORM) Query Only
 */
trait ErpQueryTrait{
  // Query (CQRS)

  /**
   * Check if alias alias existed
   *
   * @param QueryBuilder $qb
   * @param string $alias
   *
   * @return bool
   */
  protected function isAliasExiste(QueryBuilder $qb, string $alias){
    return in_array($alias, $qb->getAllAliases());
  }

  /**
   * Create Base QueryBuilder
   *
   * @param QueryBuilder $qb      previous query builder.
   *
   * @return QueryBuilder
   */
  protected function searchBaseQuery(QueryBuilder $qb){
    return $qb
      ->select('_entity')
    ;
  }

  /**
   * Assign Search QueryBuilder
   *
   * @param array $params         search parameters.
   *
   * @return QueryBuilder
   */
  protected function searchAssignQuery(array $params){
    $qb = $this->searchBaseQuery(
      $this->createQueryBuilder('_entity')
    );

    return $qb;
  }

  /**
   * Execute Search QueryBuilder
   *
   * @param Query $q              query.
   * @param array $params         search parameters.
   *
   * @return mixed
   */
  protected function searchExecute(Query $q, array $params){
    if(
      array_key_exists('limit', $params) &&
      !empty($limit = (int)$params['limit'])
    ){
      $offset = array_key_exists('offset', $params)? (int)$params['offset'] : 0;
      $q->setMaxResults($limit);
      $q->setFirstResult($offset);
    }

    return $q->getResult();
  }

  /**
   * @inheritDoc
   */
  public function search(array $params){
    return $this->searchExecute(
      $this->searchAssignQuery($params)->getQuery(), $params
    );
  }
}
