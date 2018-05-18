<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

interface SimpleCommandHandler
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

    /**
     * Lock object
     *
     * @param mixed $obj
     * @param mixed $locakMode
     */
    public function lock($obj, $lockMode);

    /**
     * Execute command
     *
     * @param callable $func The function to execute.
     *
     * @return mixed The non-empty value returned from the closure or true instead.
     */
    public function execute($func);
}
