<?php

namespace Erp\Bundle\CoreBundle\Controller;

use Erp\Bundle\CoreBundle\Authorization\ContinueException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * ERP Api Query
 *
 * @Rest\View(serializerEnableMaxDepthChecks=true)
 */
abstract class ErpApiQuery extends FOSRestController
{
    use ErpContextTrait;

    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\ErpQuery
     */
    protected $domainQuery;

    protected function listResponse($data, $context)
    {
        $context = $this->prepareContext($context);

        if (!isset($context['searchable'])) {
            $context['searchable'] = true;
        }

        foreach (['add'] as $action) {
            if (!in_array($action, $context['actions'])) {
                $context['actions'][] = $action;
            }
        }

        $context['actions'] = $this->prepareActions($context['actions'], $data);
        $context['data'] = $data;

        return $context;
    }

    protected function listQuery(ServerRequestInterface $request, $callbacks)
    {
        $newCallbacks = array_map(function($callback) use ($request) {
            return function($grants) use ($request, $callback) {
                $queryParams = $request->getQueryParams();
                $items = [];
                $context = [];

                $items = $callback($queryParams, $context);

                return [$items, $context];
            };
        }, $callbacks);

        $result = $this->tryGrant($newCallbacks);

        if($result instanceof AccessDeniedException) {
            throw new AccessDeniedException("List is not allowed.");
        }

        list($items, $context) = $result;
        return $this->view($this->listResponse($items, $context), 200);
    }

    /**
     * list action
     *
     * @Rest\Get("")
     *
     * @param ServerRequestInterface $request
     */
    public function listAction(ServerRequestInterface $request)
    {
        return $this->listQuery($request, [
            'list' => function($queryParams, &$context) {
                if (!empty($queryParams)) {
                    return $this->domainQuery->search($queryParams, $context);
                } else {
                    return $this->domainQuery->findAll();
                }
            },
        ]);
    }

    protected function getResponse($data, $context)
    {
        if(empty($data)) throw new NotFoundHttpException("Entity not found.");
        $context = $this->prepareContext($context);

        $context['actions'][] = 'edit';
        $context['actions'][] = 'delete';

        $context['actions'] = $this->prepareActions($context['actions'], $data);
        $context['data'] = $data;

        return $context;
    }

    protected function getQuery($id, ServerRequestInterface $request, $callbacks)
    {
        $newCallbacks = array_map(function($callback) use ($id, $request) {
            return function($grants) use ($id, $request, $callback) {
                $queryParams = $request->getQueryParams();
                $item = null;
                $context = [];

                $item = $callback($id, $queryParams, $context);

                if (!$this->grant($grants, [$item])) {
                    return new ContinueException();
                }

                return [$item, $context];
            };
        }, $callbacks);

        $result = $this->tryGrant($newCallbacks);

        if($result instanceof AccessDeniedException) {
            throw new AccessDeniedException("Get is not allowed.");
        }

        list($item, $context) = $result;
        return $this->view($this->getResponse($item, $context), 200);
    }

    /**
     * get action
     *
     * @Rest\Get("/{id}")
     *
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function getAction($id, ServerRequestInterface $request)
    {
        return $this->getQuery($id, $request, [
            'get' => function($id, $queryParams, &$context) {
                return $this->domainQuery->findWith($id, $queryParams);
            },
        ]);
    }
}
