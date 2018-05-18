<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

class SearchQueryRegistryService implements SearchQueryRegistry
{
    protected $searchQueries = [];

    /** {@inheritDoc} */
    public function register(SearchQuery $searchQuery): void
    {
        if(!in_array($searchQuery, $this->searchQueries)) {
            $this->searchQueries[] = $searchQuery;
        }
    }

    /** {@inheritDoc} */
    public function getSearchQueries(): array
    {
        return $this->searchQueries;
    }
}
