<?php
namespace Erp\Bundle\CoreBundle\Domain\CQRS\Command;

use Erp\Bundle\CoreBundle\Entity\CoreAccount;

/**
 *
 * @author pachara
 *        
 */
interface CoreAccountCommand
{
    /**
     * Merge CoreAccount together.
     * 
     * @param CoreAccount $target
     * @param CoreAccount $origin
     * @return callable
     */
    function merge(CoreAccount $target, CoreAccount $origin): callable;
}

