<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

use Erp\Bundle\CoreBundle\Model\ThingTrait;
/**
 * @ORM\Entity
 * @ORM\Table(name="public.thing")
 */
class Thing implements ThingInterface{
    use ThingTrait;

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
}
