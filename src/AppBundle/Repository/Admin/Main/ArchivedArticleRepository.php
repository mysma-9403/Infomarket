<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Filter\Admin\Main\ArticleFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArchivedArticleRepository extends ImageEntityRepository
{	
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		parent::buildJoins($builder, $filter);
	
		if(count($filter->getBrands()) > 0) {
			$builder->leftJoin(ArticleBrandAssignment::class, 'aba', Join::WITH, 'e.id = aba.article');
		}
		
		if(count($filter->getCategories()) > 0) {
			$builder->leftJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		}
		
		if(count($filter->getArticleCategories()) > 0) {
			$builder->leftJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.date', 'DESC');
		
		parent::buildOrderBy($builder, $filter);
	
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.subname';
		$fields[] = 'e.featured';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		$where->add($builder->expr()->eq('e.archived', 1));
		$where->add('e.parent IS NULL');
		
		if(count($filter->getBrands()) > 0) {
			$where->add($builder->expr()->in('aba.brand', $filter->getBrands()));
		}
		
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('aca.category', $filter->getCategories()));
		}
		
		if(count($filter->getArticleCategories()) > 0) {
			$where->add($builder->expr()->in('aaca.articleCategory', $filter->getArticleCategories()));
		}
	
		if($filter->getFeatured() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.featured', $filter->getFeatured()));
		}
		
		if($filter->getSubname() && strlen($filter->getSubname()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.subname', $filter->getSubname()));
		}
	
		return $where;
	}
	
	
	
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		parent::buildFilterOrderBy($builder);
		
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);

		$expr = $builder->expr();
		
		$where->add($expr->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		return $where;
	}
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.subname';
		
		return $fields;
	}
	
	
	
	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
	
		$fields[] = $item['subname'];
	
		return $fields;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Article::class;
	}
}
