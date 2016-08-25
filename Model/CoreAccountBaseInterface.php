<?php

namespace Erp\Bundle\CoreBundle\Model;

/**
 */
interface CoreAccountBaseInterface{
    /**
     * Set account
     *
     * @param CoreAccountInterface $account
     *
     * @return CoreAccountBaseInterface
     */
    public function setCoreAccount(CoreAccountInterface $account);

    /**
     * Get account
     *
     * @return CoreAccountInterface
     */
    public function getCoreAccount();
}
