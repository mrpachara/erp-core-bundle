<?php

namespace Erp\Bundle\CoreBundle\Model;

use JMS\Serializer\Annotation as JMSSerializer;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

/**
 * Core Account Trait
 */
trait CoreAccountTrait{
    /**
     * @inheritDoc
     *
     * @JMSSerializer\VirtualProperty
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setThing(ThingInterface $thing){
        $this->thing = $thing;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getThing(){
        return $this->thing;
    }

    /**
     * @inheritDoc
     */
    public function setCode(string $code){
        $this->code = $code;

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @JMSSerializer\VirtualProperty
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name){
        $this->thing->setName($name);

        return $this;
    }

    /**
     * @inheritDoc
     *
     * @JMSSerializer\VirtualProperty
     */
    public function getName(){
        return $this->thing->getName();
    }

    /**
     * @inheritDoc
     */
    public function __toString(){
        return $this->getCode();
    }
}
