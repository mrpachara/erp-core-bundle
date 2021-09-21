<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\QueryBuilder;

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
     * Generate associtive array with the given prefix.
     */
    public function generateParameters(string $prefix, array $values): array;

    /**
     * Prefix given parameters key with :.
     */
    public function getParametersNames(array $parameters): array;

    /**
     * Append ArrayCoollection<int, Parameter> to QueryBuilder $qb.
     *
     * @param ArrayCollection<int, Parameter> $parameters
     */
    public function appendParameters(QueryBuilder $qb, ArrayCollection $parameters): QueryBuilder;

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
