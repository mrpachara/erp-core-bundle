<?php

namespace Erp\Bundle\CoreBundle\Authorization;

trait ErpReadonlyAuthorizationTrait
{
    use ErpUncreatableAuthorizationTrait;
    use ErpUnupdatableAuthorizationTrait;
    use ErpUndeletableAuthorizationTrait;
}
