<?php

namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * CoreAccount Api Controller
 *
 * @Rest\Version("1.0")
 * @Rest\Route("/api/core-account")
 */
class CoreAccountApiQueryController extends CoreAccountApiQuery {
  /**
   * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CoreAccountQuery
   */
  protected $domainQuery;

  /**
   * @var \Erp\Bundle\CoreBundle\Authorization\AbstractCoreAccountAuthorization
   */
  protected $authorization;
}
