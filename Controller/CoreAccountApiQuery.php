<?php

namespace Erp\Bundle\CoreBundle\Controller;

/**
 * Core Account Api Query
 */
abstract class CoreAccountApiQuery extends ErpApiQuery
{
    /**
     * @var \Erp\Bundle\CoreBundle\Authorization\AbstractCoreAccountAuthorization
     */
    protected $authorization = null;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountQuery
     */
    protected $domainQuery;
}
