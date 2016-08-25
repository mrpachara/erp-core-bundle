<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.deep1", uniqueConstraints={@ORM\UniqueConstraint(columns={"code"})})
 * @ORM\InheritanceType("JOINED")
 */
class CoreDeep1{
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
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $name;

    public function __construct(){
        parent::__construct();
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
        $this->name = $name;

        return $this;
    }

    public function getName(){
        return $this->name;
    }
}
