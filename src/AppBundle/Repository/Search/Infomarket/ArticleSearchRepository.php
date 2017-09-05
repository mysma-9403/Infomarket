<?php

namespace AppBundle\Repository\Search\Infomarket;

use AppBundle\Entity\Assignments\ArticleBrandAssignment;
use AppBundle\Entity\Assignments\ArticleCategoryAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Search\BrandCategorySearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleSearchRepository extends SearchRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		if (count($filter->getCategories()) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		} else if (count($filter->getBrands()) > 0) {
			$builder->innerJoin(ArticleBrandAssignment::class, 'aba', Join::WITH, 'e.id = aba.article');
		}
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.subname';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BrandCategorySearchFilter $filter */
		$expr = $builder->expr();
		$where = $expr->andX();
		
		if (count($filter->getCategories()) > 0) {
			$where->add($expr->in('aca.category', $filter->getCategories()));
		} else if (count($filter->getBrands()) > 0) {
			$where->add($expr->in('aba.brand', $filter->getBrands()));
		}
		
		// TODO make automated from array [e.name, e.subname] + use in other (admin) repositories
		if ($filter->getString() && strlen($filter->getString()) > 0) {
			$name = $expr->concat($expr->trim('e.name'), $expr->literal(' '));
			$name = $expr->concat($name, $expr->trim('e.subname'));
			$where->add($this->buildStringsExpression($builder, $name, $filter->getString(), true));
		}
		
		$where->add($expr->eq('e.infomarket', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Article::class;
	}
}
