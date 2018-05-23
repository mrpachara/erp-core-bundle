<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM;

use Doctrine\ORM\Id\AbstractIdGenerator;

class UuidGenerator extends AbstractIdGenerator
{
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        return \Erp\Bundle\CoreBundle\Util\Uuid::uuidv4();
    }
}
