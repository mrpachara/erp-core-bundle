<?php

namespace Erp\Bundle\CoreBundle\Collection;

use Erp\Bundle\CoreBundle\Entity\StatusPresentable;

/**
 * Rest HTTP Response
 */
class RestResponse{
  /** @var mixed */
  protected $data;

  /** @var string */
  protected $refCode;

  /** @var array */
  protected $actions;

  /** @var array */
  protected $links;

  /** @var bool */
  protected $searchable;

  /** @var string */
  protected $searchTerm;

  /** @var array */
  protected $pagination;

  /**
   * Constructor
   *
   * @param mixed $data
   */
  public function __construct($data, $meta = null){
    $meta = (array)$meta;

    $this->actions = [];
    $this->links = [];

    if($data instanceof StatusPresentable) {
      if($data->updatable()) $this->actions[] = 'edit';
      if($data->deletable()) $this->actions[] = 'delete';
    } else if(is_array($data)) {
      $this->actions[] = 'add';
      $this->searchable = true;
    }

    if(array_key_exists('pagination', $meta)) $this->pagination = $meta['pagination'];
    if(array_key_exists('searchTerm', $meta)) $this->searchTerm = $meta['searchTerm'];

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
   * Get Reference Code
   *
   * @return string
   */
  public function getRefCode() {
    return $this->refCode;
  }

  /**
   * Get Actions
   *
   * @return mixed
   */
  public function getActions() {
    return $this->actions;
  }

  /**
   * Get Links
   *
   * @return mixed
   */
  public function getLinks() {
    return $this->links;
  }

  /**
   * Get Searchable
   *
   * @return bool
   */
  public function getSearchable() {
    return $this->searchable;
  }

  /**
   * Get SearchTerm
   *
   * @return string
   */
  public function getSearchTerm() {
    return $this->searchTerm;
  }

  /**
   * Get Paginator
   *
   * @return array
   */
  public function getPagination() {
    return $this->pagination;
  }
}
