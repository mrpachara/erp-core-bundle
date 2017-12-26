<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

/**
 * Container for provide CQRS as service
 */
class CQRSContainer{
  /**
   * @var ErpQuery
   */
  private $_query;

  /**
   * @var ErpCommand
   */
  private $_command;

  /**
   * Constructor
   *
   * @param ErpQuery $query
   * @param ErpCommand $command
   */
  function __construct($query, $command){
    $this->_query = $query;
    $this->_command = $command;
  }

  /**
   * Get Repository
   *
   * @return ErpQuery
   */
  function query(){
    return $this->_query;
  }

  /**
   * Get Command
   *
   * @return ErpCommand
   */
  function command(){
    return $this->_command;
  }
}
