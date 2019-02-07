<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Command;

use Erp\Bundle\CoreBundle\Domain\CQRS\Command\PersistanceCommand as CommandInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @author pachara
 *        
 */
class PersistanceCommand implements CommandInterface
{
    /**
     * @var EntityManager
     */
    private $em;
    
    public function __construct(
        RegistryInterface $doctrine
    )
    {
        $this->em = $doctrine->getEntityManager();
    }
    
    /**
     * {@inheritdoc}
     */
    public function detach(object $obj): callable
    {
        $em = $this->em;
        return function() use ($em, $obj) {
            return $em->detach($obj);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function refresh(object $obj): callable
    {
        $em = $this->em;
        return function() use ($em, $obj) {
            return $em->refresh($obj);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function persist(object $obj): callable
    {
        $em = $this->em;
        return function() use ($em, $obj) {
            return $em->persist($obj);
        };
    }

    /**
     * {@inheritdoc}
     */
    public function remove(object $obj): callable
    {
        $em = $this->em;
        return function() use ($em, $obj) {
            return $em->remove($obj);
        };
    }
}

