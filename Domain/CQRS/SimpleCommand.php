<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

interface SimpleCommand
{
    /**
     * Save object and update to latest value
     *
     * @param mixed $obj
     */
    public function save($obj);

    /**
     * Delete object
     *
     * @param mixed $obj
     */
    public function delete($obj);
}
