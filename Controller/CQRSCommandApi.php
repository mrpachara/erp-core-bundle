<?php

namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * CQRS Api Command
 */
abstract class CQRSCommandApi extends FOSRestController{
  use CommandApiTrait;

  /**
   * @var \Erp\Bundle\CoreBundle\Serializer\Serializer
   */
  protected $serializer;

  /**
   * @var \Erp\Bundle\CoreBundle\Domain\CQRS\CQRSContainer
   */
  protected $cqrs;

  /**
   * create action
   *
   * @Rest\Put("")
   *
   * @param Request $request
   */
  public function createAction(Request $request){
    return $this->createCommand($request->getContent(), $request->getContentType());
  }

  /**
   * update action
   *
   * @Rest\Put("/{id}")
   *
   * @param string $id
   * @param Request $request
   */
  public function updateAction($id, Request $request){
    if($item = $this->cqrs->query()->find($id)) {
      return $this->updateCommand($item, $request->getContent(), $request->getContentType());
    } else {
      throw new HttpException(404, "Entity not found.");
    }
  }

  /**
   * delete action
   *
   * @Rest\Delete("/{id}")
   *
   * @param string $id
   * @param Request $request
   */
  public function deleteAction($id, Request $request){
    return $this->deleteCommand($this->cqrs->query()->find($id));
  }
}
