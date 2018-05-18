<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * Query Helper
 */
interface QueryHelper
{
    /**
     * Check if alias existed
     *
     * @param QueryBuilder $qb
     * @param string $alias
     *
     * @return bool
     */
    public function isAliasExisted(QueryBuilder $qb, string $alias);

    /**
     * Generate final filed name from nested file name and add possible leftJoin
     *
     * @param QueryBuilder $qb
     * @param string $alias     Domain alias
     * @param string filed      Filed name
     *
     * @return string
     */
    public function generateFieldName(QueryBuilder $qb, string $alias, string $field);

    /**
     * Execute Search Query
     *
     * @param Query $q              query.
     * @param array $params         search parameters.
     * @param array &$context       query context.
     *
     * @return mixed
     */
    public function execute(Query $q, array $params, array &$context = null);
}
