<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

interface SearchQueryRegistry
{
    /**
     * Register SearchQuery
     *
     * @param SearchQuery $searchQuery
     */
    public function register(SearchQuery $searchQuery): void;

    /**
     * Get all SearchQuery
     *
     * @return SearchQuery[]
     */
    public function getSearchQueries(): array;
}
