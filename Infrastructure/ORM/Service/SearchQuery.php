<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;

interface SearchQuery
{
    /**
     * Assign Search to QueryBuilder
     *
     * @param QueryBuilder $qb
     * @param array $params           search parameters.
     * @param string $alias           Domain alias
     * @param array $option           array of search options
     * @param array &$context         reference to return context
     *
     * @return QueryBuilder
     */
    public function assign(QueryBuilder $qb, array $params, string $alias, ?array $options, array &$context = null);

    /**
     * Query Parameter Name
     *
     * @return string
     */
    public function paramName();
}
