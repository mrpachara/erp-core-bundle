<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search Where Query Service
 */
class SearchWhereQueryService implements SearchQuery
{
    /** @var QueryHelperService */
    protected $qh;

    public function __construct(QueryHelperService $qh)
    {
        $this->qh = $qh;
    }

    protected function filterByKey($params)
    {
        $prefix = $this->paramName().':';
        $result = [];
        $affectedParams = array_intersect_key($params, array_flip(preg_grep('/^'.preg_quote($prefix).'/', array_keys($params))));
        foreach($affectedParams as $key => $value) {
            $result[substr($key, strlen($prefix))] = $value;
        }

        return $result;
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

        $i = 0;
        foreach($this->filterByKey($params) as $key => $value) {
            if(in_array($key, $options['fields'])) {
                $filedName = $this->qh->generateFieldName($qb, $alias, $key);
                $valueName = "_value_search_where_{$i}";
                $i++;
                $qb
                    ->andWhere("{$filedName} = :{$valueName}")
                    ->setParameter($valueName, $value)
                ;
            }
        }

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function paramName()
    {
        return 'where';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'fields'     => [],
        ]);
    }
}
