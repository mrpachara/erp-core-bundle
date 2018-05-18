<?php

namespace Erp\Bundle\CoreBundle\Authorization;

trait ErpUncreatableAuthorizationTrait
{
    public function add(...$args) {
        return false;
    }
}
