<?php

namespace Erp\Bundle\CoreBundle\Repository\ORM;

use Doctrine\ORM\EntityRepository;
use Erp\Bundle\CoreBundle\Model\ThingInterface;
use Erp\Bundle\CoreBundle\Repository\CoreAccountRepositoryInterface;

/**
 * Core account repository (ORM)
 */
class CoreAccountRepository extends EntityRepository implements CoreAccountRepositoryInterface{
    use UpdatableRepositoryTrait{
        remove as private base_remove;
    }

    public function findThing(ThingInterface $thing){
        return $this->findBy([
            'thing' => $thing->getId(),
        ]);
    }

    public function remove($entity){
        $this->base_remove($entity);

        try{
            $em = $this->getEntityManager();
            $em->remove($entity->getThing());
            $em->flush();
        } catch(\Exception $excp){}
    }
}
