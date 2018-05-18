<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search Term Query Service
 */
class SearchTermQueryService implements SearchQuery
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

        if(array_key_exists('search', $params)) {
            $term = $params['search'];

            if(count($options['fields']) > 0) {
                $orX = $qb->expr()->orX();
                foreach($options['fields'] as $field) {
                    $filedName = $this->qh->generateFieldName($qb, $alias, $field);
                    $orX->add("{$filedName} LIKE :term");
                }
                $qb->andWhere($orX);
                $qb->setParameter('term', "%{$term}%");
            } else {
                $qb->andWhere('FALSE = TRUE');
            }

            $context['searchTerm'] = $term;
        }

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function paramName()
    {
        return 'term';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'fields'     => [],
        ]);
    }
}
