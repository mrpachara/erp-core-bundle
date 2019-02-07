<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\Common\Command;

use Erp\Bundle\CoreBundle\Domain\CQRS\Command\CoreAccountCommand as CommandInterface;
use Erp\Bundle\CoreBundle\Entity\CoreAccount;
use Erp\Bundle\CoreBundle\Domain\CQRS\Command\PersistanceCommand;
use Erp\Bundle\CoreBundle\Domain\CQRS\Query\CoreAccountQuery;
use Erp\Bundle\CoreBundle\Domain\Adapter\LockMode;
use Erp\Bundle\CoreBundle\Domain\CQRS\Command\CommandHandler;

/**
 *
 * @author pachara
 *        
 */
class CoreAccountCommand implements CommandInterface
{
    private $domainQuery;
    private $persistanceCommand;
    private $commandHandler;

    /**
     */
    public function __construct(
        CoreAccountQuery $domainQuery,
        PersistanceCommand $persistanceCommand,
        CommandHandler $commandHander
    )
    {
        $this->domainQuery = $domainQuery;
        $this->persistanceCommand = $persistanceCommand;
        $this->commandHandler = $commandHander;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(CoreAccount $target, CoreAccount $origin): callable
    {
        $domainQuery = $this->domainQuery;
        $persistanceCommand = $this->persistanceCommand;
        $commandHandler = $this->commandHandler;
        return function() use($target, $origin, $domainQuery, $persistanceCommand, $commandHandler) {
            $oldThing = $target->getThing();
            /**
             * @var CoreAccount $account
             */
            foreach($domainQuery->getRelatedAccount($target, LockMode::PESSIMISTIC_WRITE) as $account) {
                $account->setThing($origin->getThing());
            }
            $commandHandler->invoke($persistanceCommand->remove($oldThing));
        };
    }
}

