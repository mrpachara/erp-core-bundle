<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.deep2")
 * @ORM\InheritanceType("JOINED")
 */
class CoreDeep2 extends CoreDeep1{
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $att2;

    public function __construct(){
        parent::__construct();
    }

    public function setAtt2(string $att2){
        $this->att2 = $att2;

        return $this;
    }

    public function getAtt2(){
        return $this->att2;
    }
}
