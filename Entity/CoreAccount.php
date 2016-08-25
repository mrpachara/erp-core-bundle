<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;
use Erp\Bundle\CoreBundle\Model\ThingBaseInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.account", uniqueConstraints={@ORM\UniqueConstraint(columns={"code"})})
 */
class CoreAccount implements CoreAccountInterface, ThingBaseInterface{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Thing", cascade={"persist"})
     * @ORM\JoinColumn(name="id_thing", nullable=false, onDelete="cascade")
     *
     * @var ThingInterface
     */
    private $thing;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @var string
     */
    private $code;

    /**
     * constructor
     */
    public function __construct(){
        $this->thing = new Thing();
    }

    public function setThing(ThingInterface $thing){
        $this->thing = $thing;

        return $this;
    }

    public function getThing(){
        return $this->thing;
    }

    public function getId(){
        return $this->id;
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
