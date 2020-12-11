<?php

namespace AppBundle\Repository\Search\Infoprodukt;

use AppBundle\Entity\Assignments\TermCategoryAssignment;
use AppBundle\Entity\Main\Term;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Search\BrandCategorySearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class TermSearchRepository extends SearchRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		if (count($filter->getCategories()) > 0) {
			$builder->innerJoin(TermCategoryAssignment::class, 'tca', Join::WITH, 'e.id = tca.term');
		}
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BrandCategorySearchFilter $filter */
		$where = null;
		
		$expr = $builder->expr();
		
		if (count($filter->getCategories()) > 0) {
			$where = $expr->andX();
			$where->add($expr->in('tca.category', $filter->getCategories()));
		} else {
			$where = parent::getWhere($builder, $filter);
		}
		
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Term::class;
	}
}
