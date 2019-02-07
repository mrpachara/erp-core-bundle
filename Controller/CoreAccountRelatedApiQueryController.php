<?php
namespace Erp\Bundle\CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Psr\Http\Message\ServerRequestInterface;

/**
 *
 * @author pachara
 *        
 * @Rest\Version("1.0")
 * @Rest\Route("/api/core-account-related")
 */
class CoreAccountRelatedApiQueryController
{
    private $domainQuery;

    /**
     */
    public function __construct(
        \Erp\Bundle\CoreBundle\Domain\CQRS\Query\CoreAccountQuery $domainQuery
    )
    {
        $this->domainQuery = $domainQuery;
    }
    
    /**
     * get action
     *
     * @Rest\Get("/{id}")
     *
     * @param string $id
     * @param ServerRequestInterface $request
     */
    public function getAction(string $id, ServerRequestInterface $request)
    {
        /** 
         * @var \Erp\Bundle\CoreBundle\Entity\CoreAccount $coreAccount
         */
        $coreAccount = $this->domainQuery->find($id);
        
        return [
            'data' => $this->domainQuery->getRelatedAccount($coreAccount)
        ];
    }
}

