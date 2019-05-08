<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * Core account Entity
 */
abstract class CoreAccount implements StatusPresentable
{

    /**
    * @var string
    */
    private $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * Dummy for serializable
     *
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $active = true;

    /**
     * @var string
     */
    protected $remark;

    /**
     * @var Thing
     */
    protected $thing;

    /**
     * ConstructorTest
     *
     * @param Thing|null $thing
     */
    public function __construct(Thing $thing = null)
    {
        $this->thing = ($thing === null)? new Thing() : $thing;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set thing
     *
     * @param Thing $thing
     *
     * @return CoreAccount
     */
    public function setThing(Thing $thing)
    {
        $this->thing = $thing;

        return $this;
    }

    /**
     * Get thing
     *
     * @return Thing
     */
    public function getThing()
    {
        return $this->thing;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CoreAccount
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return CoreAccount
     */
    public function setName(string $name)
    {
        if (null === $this->thing) {
            $this->thing = new Thing();
        }
        $this->thing->setName($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        if (null === $this->thing) {
            $this->thing = new Thing();
        }
        return $this->thing->getName();
    }

    /**
     * Set active
     *
     * @param bool $active
     *
     * @return Thing
     */
    public function setActive(bool $active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return static
     */
    public function setRemark(string $remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    public function updatable()
    {
        return $this->active;
    }

    public function deletable()
    {
        return $this->active;
    }
}
