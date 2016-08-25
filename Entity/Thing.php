<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.thing")
 */
class Thing implements ThingInterface{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     *
     * @var string
     */
    private $name;

    /**
     * constructor
     */
    public function __construct(){
    }

    public function getId(){
        return $this->id;
    }

    public function setName(string $name){
        $this->thing->setName($name);

        return $this;
    }

    public function getName(){
        return $this->thing->getName();
    }
}
