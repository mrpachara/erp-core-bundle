<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\EntityManager;

use Erp\Bundle\CoreBundle\Domain\CQRS\SimpleCommandHandler as CommandHandlerInterface;

class SimpleCommandHandlerService extends Command implements CommandHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    /**
     * {@inheritdoc}
     */
    public function persist($obj)
    {
        $this->em->persist($obj);
        return $obj;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($obj)
    {
        $this->em->remove($obj);
        return $obj;
    }

    /**
     * {@inheritdoc}
     */
    public function lock($obj, $lockMode)
    {
        $this->em->lock($obj, $lockMode);
        return $obj;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($func)
    {
        return $this->em->transactional($func);
    }
}
