<?php

namespace Erp\Bundle\CoreBundle\Collection;

use Erp\Bundle\CoreBundle\Entity\StatusPresentable;

/**
 * Rest HTTP Response
 */
class RestResponse{
  /** @var mixed */
  protected $data;

  /** @var array */
  protected $actions;

  /**
   * Constructor
   *
   * @param mixed $data
   */
  public function __construct($data){
    $this->actions = [];

    if($data instanceof StatusPresentable) {
      if($data->updatable()) $this->actions[] = 'edit';
      if($data->deletable()) $this->actions[] = 'delete';
    } else if(is_array($data)) {
      $this->actions[] = 'add';
    }

    $this->data = $data;
  }

  /**
   * Get Data
   *
   * @return mixed
   */
  public function getData(){
    return $this->data;
  }

  /**
   * Get Actions
   *
   * @return mixed
   */
  public function getActions() {
    return $this->actions;
  }
}
