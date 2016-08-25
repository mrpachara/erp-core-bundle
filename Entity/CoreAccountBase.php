<?php

namespace Erp\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Erp\Bundle\CoreBundle\Model\CoreAccountBaseInterface;
use Erp\Bundle\CoreBundle\Model\CoreAccountInterface;

/**
 * @ORM\MappedSuperclass
 */
class CoreAccountBase implements CoreAccountInterface, CoreAccountBaseInterface{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="CoreAccount", cascade={"persist"})
     * @ORM\JoinColumn(name="id_account", nullable=false, onDelete="cascade")
     *
     * @var AccountInterface
     */
    private $account;

    /**
     * constructor
     */
    public function __construct(){
        parent::__construct();
        $this->account = new Account();
    }

    public function getId(){
        return $this->id;
    }

    public function setCode(string $code){
        $this->account->setCode($code);

        return $this;
    }

    public function getCode(){
        return $this->account->getCode();
    }

    public function setName(string $name){
        $this->account->setName($name);

        return $this;
    }

    public function getName(){
        return $this->account->getName();
    }

    public function setCoreAccount(CoreAccountInterface $account){
        $this->account = $account;

        return $this;
    }

    public function getCoreAccount(){
        return $this->account;
    }
}
