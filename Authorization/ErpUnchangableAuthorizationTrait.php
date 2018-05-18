<?php

namespace Erp\Bundle\CoreBundle\Authorization;

trait ErpUnchangableAuthorizationTrait
{
    use ErpUnupdatableAuthorizationTrait;
    use ErpUndeletableAuthorizationTrait;
}
