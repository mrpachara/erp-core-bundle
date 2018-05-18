<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Entity\Thing;
use Erp\Bundle\CoreBundle\Entity\CoreAccount;

/**
 * CoreAccount Query (CQRS)
 */
interface CoreAccountQuery extends ErpQuery
{
    /**
     * Create new Core Account
     *
     * @param Thing $thing
     */
    //function create(Thing $thing = null);

    /**
     * find Entity by thing
     *
     * @param Thing $thing
     *
     * @return array
     */
    public function findThing(Thing $thing);
}
