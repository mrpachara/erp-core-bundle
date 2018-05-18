<?php

namespace Erp\Bundle\CoreBundle\Authorization;

trait ErpUndeletableAuthorizationTrait
{
    public function delete(...$args) {
        return false;
    }
}
