<?php

namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Listener;

use Doctrine\ORM\Event\PreFlushEventArgs;
use Erp\Bundle\CoreBundle\Entity\TempFileItem;

class TempFileItemListener {

  public function preFlush(TempFileItem $entity, PreFlushEventArgs $event) {
    $entity->setTstmp(new \DateTimeImmutable());
  }
}
