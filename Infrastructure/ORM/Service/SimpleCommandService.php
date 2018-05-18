<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\EntityManager;

use Erp\Bundle\CoreBundle\Domain\CQRS\SimpleCommand as CommandInterface;

class SimpleCommandService extends Command implements CommandInterface
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
    public function save($obj)
    {
        $this->em->transactional(function() use ($obj) {
            $this->em->persist($obj);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function delete($obj)
    {
        $this->em->transactional(function() use ($obj) {
            $this->em->remove($obj);
        });
    }
}
