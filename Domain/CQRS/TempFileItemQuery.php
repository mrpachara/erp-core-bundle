<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Entity\TempFileItem;

/**
 * TempFileItem Query (CQRS)
 */
interface TempFileItemQuery
{
    /**
     * get TempFileItem from UUID
     *
     * @param string $uuid       file UUID
     *
     * @return TempFileItem
     */
    public function get(string $uuid);
}
