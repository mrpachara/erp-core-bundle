<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Helper;

use Doctrine\ORM\QueryBuilder;
use Erp\Bundle\CoreBundle\Entity\Thing;

/**
 *
 * @author pachara
 *        
 */
class CoreAccountQueryHelper
{
    const prefix = '_account_query';
    
    private $id;
    
    private $erpqh;
    /**
     */
    public function __construct(ErpQueryHelper $erpqh)
    {
        $this->id = 0;
        
        $this->erpqh = $erpqh;
    }
    
    private function getId(): string
    {
        return self::prefix.($this->id++);
    }
    
//     function queryByThings(QueryBuilder $qb, array $things): QueryBuilder
//     {
//         $alias = $this->getRootAlias($qb);
//         $params = $this->generateParamNames($things);
//         return $qb
//             ->andWhere($qb->expr()->in("{$alias}.thing", array_map(function ($paramName) {return ':'.$paramName;}, array_keys($params))))
//             ->setParameters($params)
//         ;
//     }

    function queryByThing(QueryBuilder $qb, Thing $thing): QueryBuilder
    {
        $alias = $this->erpqh->getRootAlias($qb);
        $paramName = $this->getId();
        return $qb
            ->andWhere($qb->expr()->eq("{$alias}.thing", ":{$paramName}"))
            ->setParameter($paramName, $thing)
        ;
    }
}

