<?php

namespace Erp\Bundle\CoreBundle\Model;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;
use Erp\Bundle\CoreBundle\Model\ThingBaseInterface;

/**
 * Core Account Trait
 */
trait CoreAccountTrait{
    public function getId(){
        return $this->id;
    }

    public function setThing(ThingInterface $thing){
        $this->thing = $thing;

        return $this;
    }

    public function getThing(){
        return $this->thing;
    }

    public function setCode(string $code){
        $this->code = $code;

        return $this;
    }

    public function getCode(){
        return $this->code;
    }

    public function setName(string $name){
        $this->thing->setName($name);

        return $this;
    }

    public function getName(){
        return $this->thing->getName();
    }
}
