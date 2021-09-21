<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountQuery as QueryInterface;
use Erp\BUndle\CoreBundle\Entity\Thing;

abstract class CoreAccountQuery extends ErpQuery implements QueryInterface
{
    public function searchOptions() {
        $result = parent::searchOptions();

        if(!isset($result['where'])) $result['where'] = [
            'fields' => [],
        ];
        if(!isset($result['term'])) $result['term'] = [
            'fields' => [],
        ];
        if(!isset($result['active'])) $result['active'] = [
            'fields' => [],
        ];
        if(!isset($result['order'])) $result['order'] = [
            'fields' => [],
        ];

        $result['where']['fields'][] = 'code';

        $result['term']['fields'][] = 'code';
        $result['term']['fields'][] = 'thing.name';

        $result['active']['fields'][] = 'active';

        $result['order']['fields'][] = 'code ASC';

        return $result;
    }

    public function findByThing(Thing $thing)
    {
        $arguments = func_get_args();

        return call_user_func_array([$this->repository, 'findByThing'], $arguments);
    }
}
