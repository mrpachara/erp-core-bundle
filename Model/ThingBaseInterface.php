<?php

namespace Erp\Bundle\CoreBundle\Model;

/**
 */
interface ThingBaseInterface{
    /**
     * Set thing
     *
     * @param ThingInterface $thing
     *
     * @return AccountInterface
     */
    public function setThing(ThingInterface $thing);

    /**
     * Get thing
     *
     * @return ThingInterface
     */
    public function getThing();
}
