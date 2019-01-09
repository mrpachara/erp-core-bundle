<?php
namespace Erp\Bundle\CoreBundle\Domain\CQRS\Query;

use Erp\Bundle\CoreBundle\Entity\CoreAccount;

/**
 *
 * @author pachara
 *        
 */
interface CoreAccountQuery
{
    /**
     * Get other related CoreAccount.
     *
     * @param CoreAccount $account
     * @return array
     */
    function getRelatedAccount(CoreAccount $account): array;
}

