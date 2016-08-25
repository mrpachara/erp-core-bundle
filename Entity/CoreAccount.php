<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\ThingInterface;

use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;

use Erp\Bundle\CoreBundle\Model\CoreAccountTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.account", uniqueConstraints={@ORM\UniqueConstraint(columns={"code"})})
 * @ORM\InheritanceType("JOINED")
 */
class CoreAccount implements CoreAccountInterface{
    use CoreAccountTrait;

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
        parent::__construct();
        $this->thing = new Thing();
    }
}
