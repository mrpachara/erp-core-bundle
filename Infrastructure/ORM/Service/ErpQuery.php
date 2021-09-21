<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Erp\Bundle\CoreBundle\Domain\CQRS\ErpQuery as QueryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query as ORMQuery;
use Doctrine\ORM\QueryBuilder;

abstract class ErpQuery implements QueryInterface
{
    const DOMAIN_ALIAS = '_entity';

    /** @var EntityRepository */
    protected $repository;

    /** @var QueryHelperService */
    protected $qh;

    /** @var SearchQuery[] */
    protected $searchQueries;

    abstract public function setRepository(\Symfony\Bridge\Doctrine\RegistryInterface $doctrine);

    /** @required */
    public function setQueryHelper(QueryHelper $qh)
    {
        $this->qh = $qh;
    }

    /** @required */
    public function setSearchQueries(SearchQueryRegistry $searchRegistry)
    {
        $this->searchQueries = $searchRegistry->getSearchQueries();
    }

    protected function searchOptions()
    {
        $result = [];

        $result['where'] = [
            'fields' => [],
        ];

        $result['search'] = [
            'fields' => [],
        ];

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function find($id)
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'find'], $arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'findAll'], $arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'findBy'], $arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria)
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'findOneBy'], $arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function getClassName()
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'getClassName'], $arguments);
    }

    private $runningNumber = 0;

    public function getUniqueAlias() : string
    {
        return "{static::DOMAIN_ALIAS}_".($this->runningNumber++);
    }

    public function createQueryBuilder(string $alias) : QueryBuilder
    {
        return $this->repository->createQueryBuilder($alias);
    }

    public function applySearchFilter(QueryBuilder $qb, array $params, string $alias, &$context = null) : QueryBuilder {
        $context = (array)$context;

        $searchOptions = $this->searchOptions();
        foreach($this->searchQueries as $searchQuery) {
            $searchQuery->assign(
//                $qb, $params, static::DOMAIN_ALIAS,
                $qb, $params, $alias,
                (isset($searchOptions[$searchQuery->paramName()]))?
                    $searchOptions[$searchQuery->paramName()] : [],
                $context
            );
        }

        return $qb;
    }

    public function searchQueryBuilder(array $params, string $alias, &$context = null)
    {
        $context = (array)$context;
        $qb = $this->createQueryBuilder($alias);

        return $this->applySearchFilter($qb, $params, $alias, $context);
    }

    /**
     * TODO: remove
     */
    public function searchQuery(array $params, &$context = null)
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'searchQuery'], $arguments);
    }

    /**
     * TODO: remove
     */
    public function searchExecute(ORMQuery $q, array $params, array &$meta)
    {
        return $this->repository->searchExecute($q, $params, $meta);
    }

    /**
     * {@inheritDoc}
     */
    public function search(array $params, array &$context = null)
    {
        $context = (array)$context;
        $qb = $this->searchQueryBuilder($params, static::DOMAIN_ALIAS, $context);
        return $this->qh->execute($qb->getQuery(), $params, $context);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->repository, $name], $arguments);
    }
}
