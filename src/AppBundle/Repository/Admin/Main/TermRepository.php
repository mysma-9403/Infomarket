<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Term;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Admin\Main\TermFilter;
use AppBundle\Entity\TermCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;

class TermRepository extends SimpleEntityRepository
{	
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		if(count($filter->getCategories()) > 0) {
			$builder->leftJoin(TermCategoryAssignment::class, 'tca', Join::WITH, 'e.id = tca.term');
		}
	}
	
	
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var TermFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('tca.category', $filter->getCategories()));
		}
	
		return $where;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Term::class;
	}
}
