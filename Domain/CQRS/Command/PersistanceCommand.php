<?php
namespace Erp\Bundle\CoreBundle\Domain\CQRS\Command;

/**
 *
 * @author pachara
 *        
 */
interface PersistanceCommand
{
    /**
     * Persist an object.
     * 
     * @param object $obj
     * @return callable
     */
    function persist(object $obj): callable;
    
    /**
     * Detach an object.
     * 
     * @param object $obj
     * @return callable
     */
    function detach(object $obj): callable;
    
    /**
     * Refresh an object.
     * 
     * @param object $obj
     * @return callable
     */
    function refresh(object $obj): callable;
    
    /**
     * Remove an object.
     * 
     * @param object $obj
     * @return callable
     */
    function remove(object $obj): callable;
}

