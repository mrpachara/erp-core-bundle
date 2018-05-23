<?php

namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

use Psr\Http\Message\ServerRequestInterface;

/**
 * FileUpload Api Controller
 *
 * @Rest\Version("1.0")
 * @Rest\Route("/api/file")
 */
class FileUploadApiController extends FOSRestController
{
    /**
     * @var \Erp\Bundle\CoreBundle\Domain\CQRS\TempFileItemQuery
     */
    protected $domainQuery;

    /** @required */
    public function setDomainQuery(\Erp\Bundle\CoreBundle\Domain\CQRS\TempFileItemQuery $domainQuery)
    {
        $this->domainQuery = $domainQuery;
    }

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
     * Get action
     *
     * @Rest\Get("/{uuid}")
     *
     * @param string $uuid
     *
     * @return mixed
     */
    public function getAction(string $uuid)
    {
        $tempFileItem = $this->domainQuery->get($uuid);
        
        //return $this->view($tempFileItem->getData(), 200, ['ContentType' => $tempFileItem->getMimeType()]);
        return new Response(stream_get_contents($tempFileItem->getData()), Response::HTTP_OK, ['Content-Type' => $tempFileItem->getMimeType()]);
    }

    /**
     * Put action
     *
     * @Rest\Put("")
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function putAction(Request $request)
    {
        $tempFileItem = new \Erp\Bundle\CoreBundle\Entity\TempFileItem();
        
        $this->commandHandler->execute(function() use($request, $tempFileItem) {
            $tempFileItem->setData($request->getContent());
            $tempFileItem->setMimeType($request->headers->get('CONTENT_TYPE'));
            
            $this->commandHandler->persist($tempFileItem);
        });
        
        return $this->view(['data' => [
            'uuid' => $tempFileItem->getUuid(),
        ]], 200);
    }

    /**
     * Delete action
     *
     * @Rest\Delete("/{uuid}")
     *
     * @param string $uuid
     *
     * @return mixed
     */
    public function deleteAction(string $uuid)
    {
        $tempFileItem = $this->domainQuery->get($uuid);

        $this->commandHandler->execute(function() use($tempFileItem) {
            $this->commandHandler->remove($tempFileItem);
        });

        return $this->view(['data' => [
            'uuid' => null,
        ]], 200);
    }
}
