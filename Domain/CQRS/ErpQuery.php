<?php

namespace Erp\Bundle\CoreBundle\Domain\CQRS;

use Erp\Bundle\CoreBundle\Domain\Adapter\Query;

/**
 * Erp Query (CQRS)
 */
interface ErpQuery extends Query{
  /**
   * Create new Core Account
   */
  function create();

  /**
   * Search Entity by parameters
   *
   * @param array $params
   *
   * @return mixed[]
   */
  public function search(array $params);
}
