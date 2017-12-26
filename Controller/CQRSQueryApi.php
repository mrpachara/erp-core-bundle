<?php

namespace Erp\Bundle\CoreBundle\Controller;

use Erp\Bundle\CoreBundle\Collection\RestResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Http\Message\ServerRequestInterface;

/**
 * CQRS Api Query
 */
abstract class CQRSQueryApi extends FOSRestController{
  /**
   * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CQRSContainer
   */
  protected $cqrs;

  /**
   * list action
   *
   * @Rest\Get("")
   *
   * @param ServerRequestInterface $request
   */
  public function listAction(ServerRequestInterface $request){
    $queryParams = $request->getQueryParams();
    $items = [];
    if(!empty($queryParams)){
      $items = $this->cqrs->query()->search($queryParams);
    } else{
      $items = $this->cqrs->query()->findAll();
    }

    return new RestResponse($items);
  }

  /**
   * get action
   *
   * @Rest\Get("/{id}")
   *
   * @param string $id
   * @param ServerRequestInterface $request
   */
  public function getAction($id, ServerRequestInterface $request){
    $item = $this->cqrs->query()->find($id);

    return new RestResponse($item);
  }
}
