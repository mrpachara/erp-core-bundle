<?php

namespace Erp\Bundle\CoreBundle\Security;

use Erp\Bundle\CoreBundle\Entity\StatusPresentable;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EntityStatusVolter extends Voter{
  /** @var string */
  const PREFIX = 'ENTITY_STATUS_';

  protected function supports($attribute, $subject){
    return ($subject instanceof StatusPresentable) && (strpos($attribute, static::PREFIX) == 0);
  }

  protected function voteOnAttribute($attribute, $subject, TokenInterface $token){
    /** @var StatusPresentable $entity */
    $entity = $subject;

    switch(substr($attribute, strlen(static::PREFIX))){
      case 'UPDATABLE':
        return $entity->updatable();
      case 'DELETABLE':
        return $entity->deletable();
    }

    throw new \LogicException("The attribute {$attribute} doesn't support in ".self::class);
  }
}
