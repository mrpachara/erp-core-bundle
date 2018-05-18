<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * Genrator
 */
class Generator {
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $seqgroup;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $seqnum;

    /**
     * Get id
     *
     * @return string
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $name
     *
     * @return static
     */
    public function setCode(string $code){
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix(string $prefix){
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(){
        return $this->prefix;
    }

    /**
     * Set seqgroup
     *
     * @param string $seqgroup
     *
     * @return static
     */
    public function setSeqgroup(string $seqgroup){
        $this->seqgroup = $seqgroup;

        return $this;
    }

    /**
     * Get seqgroup
     *
     * @return string
     */
    public function getSeqgroup(){
        return $this->seqgroup;
    }

    /**
     * Set length
     *
     * @param int $length
     *
     * @return static
     */
    public function setLength(int $length){
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return int
     */
    public function getLength(){
        return $this->length;
    }

    /**
     * Set seqnum
     *
     * @param int $seqnum
     *
     * @return static
     */
    public function setSeqnum(int $seqnum){
        $this->seqnum = $seqnum;

        return $this;
    }

    /**
     * Get seqnum
     *
     * @return int
     */
    public function getSeqnum(){
        return $this->seqnum;
    }

    /**
     * next generated value
     *
     * @param string $group
     *
     * @return string
     */
    public function nextValue(string $group = null) {
      if($group == $this->getSeqgroup()) {
        $this->setSeqnum($this->getSeqnum() + 1);
      } else {
        $this->setSeqgroup($group);
        $this->setSeqnum(1);
      }

      return $this->getPrefix().$this->getSeqgroup().str_pad($this->getSeqnum(), $this->getLength(), "0", STR_PAD_LEFT);
    }
}
