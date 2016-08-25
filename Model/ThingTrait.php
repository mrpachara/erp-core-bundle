<?php

namespace Erp\Bundle\CoreBundle\Model;

/**
 * Thing Trait
 */
trait ThingTrait{
    public function getId(){
        return $this->id;
    }

    public function setName(string $name){
        $this->name = $name;

        return $this;
    }

    public function getName(){
        return $this->name;
    }
}
