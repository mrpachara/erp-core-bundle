<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Domain\Adapter\Query;

/**
 * Erp Query (CQRS)
 */
interface ErpQuery extends Query
{
    /**
     * Create new Core Account
     */
    //public function create();

    /**
     * Search Entity by parameters
     *
     * @param array $params       search parameter
     * @param array &$context     returned context
     *
     * @return array
     */
    public function search(array $params, array &$context = null);
}
