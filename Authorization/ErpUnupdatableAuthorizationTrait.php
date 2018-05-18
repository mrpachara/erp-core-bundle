<?php

namespace Erp\Bundle\CoreBundle\Authorization;

trait ErpUnupdatableAuthorizationTrait
{
    public function edit(...$args) {
        return false;
    }
}
