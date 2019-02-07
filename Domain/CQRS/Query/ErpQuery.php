<?php
namespace Erp\Bundle\CoreBundle\Domain\CQRS\Query;

/**
 *
 * @author pachara
 *        
 */
interface ErpQuery
{
    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed    $id          The identifier.
     * @param int|null $lockMode    One of the \Erp\Bundle\CoreBundle\Domain\Adapter\LockMode::* constants
     *                              or NULL if no specific lock mode should be used
     *                              during the search.
     *
     * @return object|null The entity instance or NULL if the entity can not be found.
     */
    public function find($id, $lockMode = null);
}

