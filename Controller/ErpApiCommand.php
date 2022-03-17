<?php

namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Erp\Bundle\CoreBundle\Domain\Adapter\LockMode;

/**
 * ERP Api Command
 *
 * @Rest\View(serializerEnableMaxDepthChecks=true)
 */
abstract class ErpApiCommand extends FOSRestController
{
    use ErpAuthorizationTrait;

    const FOR_CREATE = 1;
    const FOR_UPDATE = 2;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\ErpQuery
     */
    protected $domainQuery;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\SimpleCommandHandler
     */
    protected $commandHandler;

    /** @required */
    public function setCommandHandler(\Erp\Bundle\CoreBundle\Domain\CQRS\SimpleCommandHandler $commandHandler)
    {
        $this->commandHandler = $commandHandler;
    }

    /**
     * @var \Erp\Bundle\CoreBundle\Serializer\Serializer
     */
    protected $serializer;

    /** @required */
    public function setSerializer(\Erp\Bundle\CoreBundle\Serializer\Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function prepareData($data, $for)
    {
        return $data;
    }

    protected function extractData(Request $request, $for)
    {
        return $data = $this->prepareData(
            $this->serializer->deserialize(
                $request->getContent(),
                'array',
                $request->getContentType()
            ),
            $for
        );
    }

    protected function prepareItemAfterPatch($item)
    {
        return $item;
    }

    protected function patchExistedItem($item, $data)
    {
        return $this->prepareItemAfterPatch($this->serializer->deserializeToExisted(
            $item,
            $data,
            $this->domainQuery->getClassName(),
            'json'
        ));
    }

    protected function createCommand(Request $request, $callbacks)
    {
        $newCallbacks = array_map(function($callback) use ($request) {
            return function($grants) use ($request, $callback) {
                $data = $this->extractData($request, self::FOR_CREATE);
                $queryParams = $request->attributes->get('queryParams', []);

                /********************************************************************
                 * NOTE: MUST throw exception, unless transaction will be commited. *
                 ********************************************************************/
                $item = $this->commandHandler->execute(function ($em) use ($callback, $data, $queryParams, $grants) {
                    $class = $this->domainQuery->getClassName();
                    if (!($item = $callback($class, $data, $queryParams))) {
                        throw new AccessDeniedException("Create is not allowed.");
                    }

                    if($this instanceof InitialItem) $this->initialItem($item);
                    $em->persist($item);
                    if (!$this->grant($grants, [$item])) {
                        throw new AccessDeniedException("Create is not allowed.");
                    }

                    return $this->patchExistedItem($item, $data);
                });

                return $item;
            };
        }, $callbacks);

        $result = $this->tryGrant($newCallbacks);

        if($result instanceof AccessDeniedException) {
            throw new AccessDeniedException("Create is not allowed.");
        }

        $item = $result;
        return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);

        // foreach($callbacks as $grantText => $callback) {
        //     $grants = preg_split('/\s+/', $grantText);
        //     if (!$this->grant($grants, [])) continue;

        //     $data = $this->extractData($request, self::FOR_CREATE);

        //     $item = $this->commandHandler->execute(function ($em) use ($callback, $data, $grants) {
        //         $class = $this->domainQuery->getClassName();
        //         if (!($item = $callback($class, $data))) {
        //             throw new AccessDeniedException("Create is not allowed.");
        //         }

        //         if($this instanceof InitialItem) $this->initialItem($item);
        //         $em->persist($item);
        //         if (!$this->grant($grants, [$item])) {
        //             throw new AccessDeniedException("Create is not allowed.");
        //         }

        //         return $this->patchExistedItem($item, $data);
        //     });

        //     return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);
        // }

        // throw new AccessDeniedException("Create is not allowed.");
    }

    /**
     * create action
     *
     * @Rest\Put("")
     *
     * @param Request $request
     */
    public function createAction(Request $request)
    {
        return $this->createCommand($request, [
            'add' => function ($class, &$data, array $queryParams) {
                return new $class();
            },
        ]);
    }

    protected function updateCommand($id, Request $request, $callbacks)
    {
        $newCallbacks = array_map(function($callback) use ($id, $request) {
            return function($grants) use ($id, $request, $callback) {
                $data = $this->extractData($request, self::FOR_UPDATE);
                $queryParams = $request->attributes->get('queryParams', []);

                /********************************************************************
                 * NOTE: MUST throw exception, unless transaction will be commited. *
                 ********************************************************************/
                $item = $this->commandHandler->execute(function ($em) use ($callback, $id, $data, $queryParams, $grants) {
                    if (!($item = $callback($id, $data, $queryParams))) {
                        throw new NotFoundHttpException("Entity not found.");
                    }
                    //$em->lock($item, LockMode::PESSIMISTIC_WRITE);
                    if (!$this->grant($grants, [$item])) {
                        throw new AccessDeniedException("Update is not allowed.");
                    }

                    return $this->patchExistedItem($item, $data);
                });

                return $item;
            };
        }, $callbacks);

        $result = $this->tryGrant($newCallbacks);

        if($result instanceof AccessDeniedException) {
            throw new AccessDeniedException("Update is not allowed.");
        }

        $item = $result;
        return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);

        // foreach($callbacks as $grantText => $callback) {
        //     $grants = preg_split('/\s+/', $grantText);
        //     if (!$this->grant($grants, [])) continue;

        //     $data = $this->extractData($request, self::FOR_UPDATE);

        //     $item = $this->commandHandler->execute(function ($em) use ($callback, $id, $data, $grants) {
        //         if (!($item = $callback($id, $data))) {
        //             throw new NotFoundHttpException("Entity not found.");
        //         }
        //         $em->lock($item, LockMode::PESSIMISTIC_WRITE);
        //         if (!$this->grant($grants, [$item])) {
        //             throw new AccessDeniedException("Update is not allowed.");
        //         }

        //         return $this->patchExistedItem($item, $data);
        //     });

        //     return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);
        // }

        // throw new AccessDeniedException("Update is not allowed.");
    }

    /**
     * update action
     *
     * @Rest\Put("/{id}")
     *
     * @param string $id
     * @param Request $request
     */
    public function updateAction($id, Request $request)
    {
        return $this->updateCommand($id, $request, [
            'edit' => function ($id, &$data, array $queryParams) {
                $queryParams['lock'] = [
                    'mode' => LockMode::PESSIMISTIC_WRITE,
                ];

                return $this->domainQuery->findWith($id, $queryParams);
            },
        ]);
    }

    protected function deleteCommand($id, Request $request, $callbacks)
    {
        $newCallbacks = array_map(function($callback) use ($id, $request) {
            return function($grants) use ($id, $request, $callback) {
                $queryParams = $request->attributes->get('queryParams', []);

                /********************************************************************
                 * NOTE: MUST throw exception, unless transaction will be commited. *
                 ********************************************************************/
                $item = $this->commandHandler->execute(function ($em) use ($callback, $id, $queryParams, $grants) {
                    if (!($item = $callback($id, $queryParams))) {
                        throw new NotFoundHttpException("Entity not found.");
                    }
                    //$em->lock($item, LockMode::PESSIMISTIC_WRITE);
                    if (!$this->grant($grants, [$item])) {
                        throw new AccessDeniedException("Delete is not allowed.");
                    }

                    $em->remove($item);
                    return $item;
                });

                return $item;
            };
        }, $callbacks);

        $result = $this->tryGrant($newCallbacks);

        if($result instanceof AccessDeniedException) {
            throw new AccessDeniedException("Delete is not allowed.");
        }

        $item = $result;
        return $this->view(['data' => $item], 200);

        // foreach($callbacks as $grantText => $callback) {
        //     $grants = preg_split('/\s+/', $grantText);
        //     if (!$this->grant($grants, [])) continue;

        //     $item = $this->commandHandler->execute(function ($em) use ($callback, $id, $grants) {
        //         if (!($item = $callback($id))) {
        //             throw new NotFoundHttpException("Entity not found.");
        //         }
        //         $em->lock($item, LockMode::PESSIMISTIC_WRITE);
        //         if (!$this->grant($grants, [$item])) {
        //             throw new AccessDeniedException("Delete is not allowed.");
        //         }

        //         $em->remove($item);
        //         return $item;
        //     });

        //     return $this->view(['data' => $item], 200);
        // }

        // throw new AccessDeniedException("Delete is not allowed.");
    }

    /**
     * delete action
     *
     * @Rest\Delete("/{id}")
     *
     * @param string $id
     * @param Request $request
     */
    public function deleteAction($id, Request $request)
    {
        return $this->deleteCommand($id, $request, [
            'delete' => function ($id, array $queryParams) {
                $queryParams['lock'] = [
                    'mode' => LockMode::PESSIMISTIC_WRITE,
                ];

                return $this->domainQuery->findWith($id, $queryParams);
            },
        ]);
    }
}
