<?php

namespace Erp\Bundle\CoreBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
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
   *
   * @DI\Inject("erp_core.service.query.core_account")
   */
  protected $domainQuery;

  /**
   * @var \Erp\Bundle\CoreBundle\Authorization\AbstractCoreAccountAuthorizationService
   *
   * @DI\Inject("erp_core.service.authorization.core_account")
   */
  protected $authorization;
}
