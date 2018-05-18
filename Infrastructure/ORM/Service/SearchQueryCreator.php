<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

class SearchQueryCreator
{
    /** @var SearchQuery[] */
    protected $searchQuerys;

    /** @var SearchQueryCreator */
    protected $parent;

    public function __construct(?SearchQueryCreator $parent, ?array $searchQuerys)
    {
        $this->parent = $parent;
        $this->searchQuerys = (array)$searchQuerys;
    }

    /**
     * Get affected SearchQuery
     *
     * @return SearchQuery[]
     */
    public function get()
    {
        $result = ($this->parent)? $this->parent->get() : [];
        foreach($this->searchQuerys as $searchQuery)
        {
            if(!in_array($searchQuery, $result)) {
                $result[] = $searchQuery;
            }
        }

        return $result;
    }
}
