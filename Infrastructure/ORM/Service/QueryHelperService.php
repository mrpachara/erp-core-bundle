<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Query Helper Service
 */
class QueryHelperService implements QueryHelper
{
    /**
     * {@inheritDoc}
     */
    public function isAliasExisted(QueryBuilder $qb, string $alias)
    {
        return in_array($alias, $qb->getAllAliases());
    }

    /**
     * {@inheritDoc}
     */
    public function generateFieldName(QueryBuilder $qb, string $alias, string $field)
    {
        $filedExts = explode('.', $field);
        $length = count($filedExts) - 1;
        for($i = 0, $length = count($filedExts) - 1; $i < $length; $i++) {
            $nextAlias = "{$alias}_{$filedExts[$i]}";
            if (!$this->isAliasExisted($qb, $nextAlias)) {
                $qb->leftJoin("{$alias}.{$filedExts[$i]}", $nextAlias);
            }
            $alias = $nextAlias;
        }

        return "{$alias}.{$filedExts[$length]}";
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Query $q, array $params, array &$context = null)
    {
        $context = (array)$context;

        if (
            array_key_exists('limit', $params) &&
            !empty($limit = (int)$params['limit'])
        ) {
            $offset = array_key_exists('offset', $params)? (int)$params['offset'] : 0;

            $context['pagination'] = [
                'offset' => $offset,
                'limit' => $limit,
                'length' => (new Paginator($q))->count(),
            ];

            $q->setMaxResults($limit);
            $q->setFirstResult($offset);
        }

        return $q->getResult();
    }
}
