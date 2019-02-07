<?php
namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Http\Message\ServerRequestInterface;
use Erp\Bundle\CoreBundle\Domain\Adapter\LockMode;
use Erp\Bundle\CoreBundle\Domain\CQRS\Command\CoreAccountCommand;
use Erp\Bundle\CoreBundle\Domain\CQRS\Query\CoreAccountQuery;
use Erp\Bundle\CoreBundle\Domain\CQRS\Command\CommandHandler;

/**
 *
 * @author pachara
 *        
 * @Rest\Version("1.0")
 * @Rest\Route("/api/core-account-related")
 */
class CoreAccountRelatedApiCommandController
{
    private $domainQuery;
    private $domainCommand;
    private $commandHandler;
    
    /**
     */
    public function __construct(
        CoreAccountQuery $domainQuery,
        CoreAccountCommand $domainCommand,
        CommandHandler $commandHandler
    )
    {
        $this->domainQuery = $domainQuery;
        $this->domainCommand = $domainCommand;
        $this->commandHandler = $commandHandler;
    }
    
    /**
     * merge action
     *
     * @Rest\Get("/{id}/merge")
     *
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function mergeAction(string $id, ServerRequestInterface $request)
    {
        $idTarget = $id;
        $idOrigin = $request->getQueryParams()['with'];
        $commandHandler =  $this->commandHandler;
        $domainCommand = $this->domainCommand;
        
        $commandHandler->execute(function() use($idTarget, $idOrigin, $commandHandler, $domainCommand) {
            /**
             * @var \Erp\Bundle\CoreBundle\Entity\CoreAccount $target
             */
            $target = $this->domainQuery->find($idTarget, LockMode::PESSIMISTIC_WRITE);
            /**
             * @var \Erp\Bundle\CoreBundle\Entity\CoreAccount $origin
             */
            $origin = $this->domainQuery->find($idOrigin, LockMode::PESSIMISTIC_WRITE);
            
            $commandHandler->invoke($domainCommand->merge($target, $origin));
        });
        
        return [
            'info' => 'success',
        ];
    }
}

