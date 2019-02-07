<?php
namespace Erp\Bundle\CoreBundle\Infrastructure\ORM\Query;

use Doctrine\ORM\EntityManager;

/**
 *
 * @author pachara
 *        
 */
trait ErpQueryTriat
{
    /**
     * @var EntityManager $repos
     */
    private $repos;
    
    /**
     * {@inheritdoc}
     */
    public function find($id, $lockMode = null)
    {
        return $this->repos->find($id, $lockMode);
    }
    
}

