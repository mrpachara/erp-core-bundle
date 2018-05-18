<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\EntityManager;

use Erp\Bundle\CoreBundle\Domain\CQRS\GeneralCommand as CommandInterface;

class GeneralCommandService extends Command implements CommandInterface
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
}
