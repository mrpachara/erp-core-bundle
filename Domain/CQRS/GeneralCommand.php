<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

interface GeneralCommand
{
    /**
     * Persist object
     *
     * @param mixed $obj
     */
    public function persist($obj);

    /**
     * Remove object
     *
     * @param mixed $obj
     */
    public function remove($obj);
}
