<?php

namespace AppBundle\Repository\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use Doctrine\ORM\EntityRepository;

abstract class BaseEntityRepository extends EntityRepository
{
	/**
	 * Find entries that mach criteria represented by provided $filter.
	 * 
	 * @param BaseEntityFilter $filter
	 */
	public function findSelected(BaseEntityFilter $filter)
	{
		return $this->querySelected($filter)->getResult();
	}
	
	/**
	 * Create query which finds entries that mach criteria represented by provided $filter. 
	 * 
	 * @param unknown $filter
	 * @return \Doctrine\ORM\Query
	 */
    public function querySelected(BaseEntityFilter $filter)
    {
    	$query = 'SELECT e';
    	$query .= ' FROM ' . $this->getEntityType() . ' e';
    	$query .= $filter->getJoinExpression();
    	$query .= $filter->getWhereExpression();
		$query .= $filter->getOrderByExpression();
    	
        $query = $this->getEntityManager()->createQuery($query);
        
        if($filter->getLimit() > 0) {
        	$query->setMaxResults($filter->getLimit());
        }
        
        return $query;
    }
    
    /**
     * Get entity type (e.g <strong>AppBundle:SimpleEntity</strong>)
     *
     * @return string
     */
	protected abstract function getEntityType();
}
