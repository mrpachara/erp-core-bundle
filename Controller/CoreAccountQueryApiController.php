<?php

namespace Erp\Bundle\CoreBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * CoreAccount Api Controller
 *
 * @Rest\Version("1.0")
 * @Rest\Route("/api/coreaccount")
 */
class CoreAccountQueryApiController extends CQRSQueryApi {
  /**
   * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CQRSContainer
   *
   * @DI\Inject("erp_core.cqrs.core_account")
   */
  protected $cqrs;
}
