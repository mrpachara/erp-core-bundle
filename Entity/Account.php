<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\AccountInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.account", uniqueConstraints={@ORM\UniqueConstraint(columns={"code"})})
 * @ORM\InheritanceType("JOINED")
 */
class Account implements AccountInterface{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @var string
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=256)
     *
     * @var string
     */
    private $name;

    /**
     * constructor
     */
    public function __construct() {
    }

    public function getId(){
        return $this->id;
    }

    public function setCode($code){
        $this->code = $code;

        return $this;
    }

    public function getCode(){
        return $this->code;
    }

    public function setName($name){
        $this->name = $name;

        return $this;
    }

    public function getName(){
        return $this->name;
    }
}
