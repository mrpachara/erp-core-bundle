<?php

namespace Erp\Bundle\CoreBundle\Service;

use Erp\Bundle\CoreBundle\Model\ThingInterface;
use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;

use Erp\Bundle\CoreBundle\Service\ErpRepositoryServiceInterface;

/**
 * Core account Service Interface
 */
interface CoreAccountServiceInterface extends ErpRepositoryServiceInterface{
    /**
     * find Entity by thing
     *
     * @param ThingInterface $thing
     *
     * @return CoreAccountInterface
     */
    public function thing(ThingInterface $thing);
}
