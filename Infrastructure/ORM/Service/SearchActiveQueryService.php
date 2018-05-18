<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\QueryBuilder;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Search Active Query Service
 */
class SearchActiveQueryService implements SearchQuery
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

        if(array_key_exists('active', $params)) {
            $andX = $qb->expr()->andX();
            if(count($options['fields']) > 0) {
                foreach($options['fields'] as $field) {
                    $filedName = $this->qh->generateFieldName($qb, $alias, $field);
                    $andX->add("{$filedName}");
                }
                $qb->andWhere($andX);
            } else {
                $qb->andWhere('FALSE');
            }
        }

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function paramName()
    {
        return 'search';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'fields'     => [],
        ));
    }
}
