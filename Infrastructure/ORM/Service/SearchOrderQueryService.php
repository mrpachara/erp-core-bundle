<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search Order Query Service
 */
class SearchOrderQueryService implements SearchQuery
{
    /** @var QueryHelperService */
    protected $qh;

    public function __construct(QueryHelperService $qh)
    {
        $this->qh = $qh;
    }

    /**
     * {@inheritDoc}
     */
    public function assign(QueryBuilder $qb, array $params, string $alias, ?array $options, array &$context = null)
    {
        $context = (array)$context;

        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $options = $resolver->resolve($options);

        foreach($options['fields'] as $orderBy) {
            $orderByExts = explode(' ', $orderBy);
            $filedName = $this->qh->generateFieldName($qb, $alias, $orderByExts[0]);
            $qb->addOrderBy($filedName, (isset($orderByExts[1]))? $orderByExts[1] : null);
        }

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function paramName()
    {
        return 'order';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'fields'     => [],
        ]);
    }
}
