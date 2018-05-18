<?php

namespace Erp\Bundle\CoreBundle\Controller;

/**
 * Core Account Api Command
 */
abstract class CoreAccountApiCommand extends ErpApiCommand
{
    /**
     * @var \Erp\Bundle\CoreBundle\Authorization\AbstractCoreAccountAuthorization
     */
    protected $authorization;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountQuery
     */
    protected $domainQuery;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\SimpleCommandHandler
     */
    protected $commandHandler;
}
