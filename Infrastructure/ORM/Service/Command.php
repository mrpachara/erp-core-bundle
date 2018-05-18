<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Service;

use Doctrine\ORM\EntityManager;

abstract class Command {
    /** @var EntityManager */
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
}
