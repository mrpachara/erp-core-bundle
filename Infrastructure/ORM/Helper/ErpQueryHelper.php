<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Helper;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;

/**
 *
 * @author pachara
 *        
 */
class ErpQueryHelper
{
    const prefix = '_erp_query';
    
    private $id;
    
    /**
     */
    public function __construct()
    {
        $this->id = 0;
    }
    
    private function getId(): string
    {
        return self::prefix.($this->id++);
    }
    
    function getRootAlias(QueryBuilder $qb, int $index = 0): string
    {
        return $qb->getRootAliases()[$index];
    }
    
    function generateParamNames(array $values): array
    {
        $results = [];
        
        foreach($values as $value) {
            $results[$this->getId()] = $value;
        }
        
        return $results;
    }
    
    /**
     * Generate Expr\orX for given array of class name.
     *
     * @param QueryBuilder $qb
     * @param array $instanceOfs
     * @return Expr\Orx
     */
    public function generateInstanceOfs(QueryBuilder $qb, array $instanceOfs): Expr\Orx
    {
        $alias = $qb->getRootAliases()[0];
        $orX = $qb->expr()->orX();
        foreach($instanceOfs as $instanceOf) {
            $orX->add($qb->expr()->isInstanceOf($alias, $instanceOf));
        }
        return $orX;
    }
}

