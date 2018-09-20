<?php

namespace Erp\Bundle\CoreBundle\Controller;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Http\Message\ServerRequestInterface;

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

    protected function listQuery($grant, ServerRequestInterface $request, $callback)
    {
        if (!$this->grant($grant, [])) {
            throw new UnprocessableEntityHttpException("List is not allowed.");
        }

        $queryParams = $request->getQueryParams();
        $items = [];
        $context = [];

        $items = $callback($queryParams, $context);

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
        return $this->listQuery('list', $request, function($queryParams, &$context) {
            if (!empty($queryParams)) {
                return $this->domainQuery->search($queryParams, $context);
            } else {
                return $this->domainQuery->findAll();
            }
        });
    }

    protected function getResponse($data, $context)
    {
        $context = $this->prepareContext($context);

        $context['actions'][] = 'edit';
        $context['actions'][] = 'delete';

        $context['actions'] = $this->prepareActions($context['actions'], $data);
        $context['data'] = $data;

        return $context;
    }

    protected function getQuery($grant, $id, ServerRequestInterface $request, $callback)
    {
        if (!$this->grant($grant, [])) {
            throw new UnprocessableEntityHttpException("Get is not allowed.");
        }

        $queryParams = $request->getQueryParams();
        $item = null;
        $context = [];

        $item = $callback($id, $queryParams, $context);

        if (!$this->grant($grant, [$item])) {
            throw new UnprocessableEntityHttpException("Get is not allowed.");
        }

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
        return $this->getQuery('get', $id, $request, function($id, $queryParams, &$context) {
            return $this->domainQuery->find($id);
        });
    }
}
