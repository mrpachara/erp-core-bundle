<?php

namespace Erp\Bundle\CoreBundle\Repository;

use Erp\Bundle\CoreBundle\Model\ThingInterface;
use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;
use Erp\Bundle\CoreBundle\Repository\ErpRepositoryInterface;

interface CoreAccountRepositoryInterface extends ErpRepositoryInterface{
    /**
     * find Entity by thing
     *
     * @param ThingInterface $thing
     *
     * @return CoreAccountInterface[]
     */
    public function findThing(ThingInterface $thing);
}
