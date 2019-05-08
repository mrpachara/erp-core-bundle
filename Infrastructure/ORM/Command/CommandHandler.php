<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Command;

use Erp\Bundle\CoreBundle\Domain\CQRS\Command\CommandHandler as CommandHandlerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @author pachara
 *        
 */
class CommandHandler implements CommandHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    
    /**
     */
    public function __construct(
        RegistryInterface $doctrine
    )
    {
        $this->em = $doctrine->getEntityManager();
    }
    
    
    /**
     * {@inheritDoc}
     */
    public function execute(callable $func): void
    {
        $this->em->transactional($func);
    }
    
    /**
     * {@inheritDoc}
     */
    public function invoke(callable $func): void
    {
        $func();
    }
}

