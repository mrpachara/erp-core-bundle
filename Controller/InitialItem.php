<?php

namespace Erp\Bundle\CoreBundle\Controller;

interface InitialItem
{
    /**
     * Initial Item after created
     *
     * @param mixed $item
     */
    public function initialItem($item);
}
