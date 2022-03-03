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

    /**
     * Finds an object by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     * @param mixed $params Parameters.
     *
     * @return object|null The object.
     */
    public function findWith($id, ?array $params = null);
}
