<?php
namespace Erp\Bundle\CoreBundle\Domain\CQRS\Command;

/**
 *
 * @author pachara
 *        
 */
interface CommandHandler
{
    /**
     * Execute command.
     * 
     * @param callable $func
     * @return void
     */
    function execute(callable $func): void;
    
    /**
     * Invoke command.
     * 
     * @param callable $func
     * @return void
     */
    function invoke(callable $func): void;
}

