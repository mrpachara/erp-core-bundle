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

    protected function createCommand($grant, Request $request, $callback)
    {
        if (!$this->grant($grant, [])) {
            throw new AccessDeniedException("Create is not allowed.");
        }

        $data = $this->extractData($request, self::FOR_CREATE);

        $item = $this->commandHandler->execute(function ($em) use ($callback, $data, $grant) {
            $class = $this->domainQuery->getClassName();
            if (!($item = $callback($class, $data))) {
                throw new AccessDeniedException("Create is not allowed.");
            }

            if($this instanceof InitialItem) $this->initialItem($item);
            $em->persist($item);
            if (!$this->grant($grant, [$item])) {
                throw new AccessDeniedException("Create is not allowed.");
            }

            return $this->patchExistedItem($item, $data);
        });

        return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);
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
        return $this->createCommand('add', $request, function ($class, &$data) {
            return new $class();
        });
    }

    protected function updateCommand($grant, $id, Request $request, $callback)
    {
        if (!$this->grant($grant, [])) {
            throw new AccessDeniedException("Update is not allowed.");
        }

        $data = $this->extractData($request, self::FOR_UPDATE);

        $item = $this->commandHandler->execute(function ($em) use ($callback, $id, $data, $grant) {
            if (!($item = $callback($id, $data))) {
                throw new NotFoundHttpException("Entity not found.");
            }
            $em->lock($item, LockMode::PESSIMISTIC_WRITE);
            if (!$this->grant($grant, [$item])) {
                throw new AccessDeniedException("Update is not allowed.");
            }

            return $this->patchExistedItem($item, $data);
        });

        return $this->view(['data' => $this->domainQuery->find($item->getId())], 200);
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
        return $this->updateCommand('edit', $id, $request, function ($id, &$data) {
            return $this->domainQuery->find($id);
        });
    }

    protected function deleteCommand($grant, $id, Request $request, $callback)
    {
        if (!$this->grant($grant, [])) {
            throw new AccessDeniedException("Delete is not allowed.");
        }

        $item = $this->commandHandler->execute(function ($em) use ($callback, $id) {
            if (!($item = $callback($id))) {
                throw new NotFoundHttpException("Entity not found.");
            }
            $em->lock($item, LockMode::PESSIMISTIC_WRITE);
            if (!$this->grant('delete', [$item])) {
                throw new AccessDeniedException("Delete is not allowed.");
            }

            $em->remove($item);
            return $item;
        });

        return $this->view(['data' => $item], 200);
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
        return $this->deleteCommand('delete', $id, $request, function ($id) {
            return $this->domainQuery->find($id);
        });
    }
}
