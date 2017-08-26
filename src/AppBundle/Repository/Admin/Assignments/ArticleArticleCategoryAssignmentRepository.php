<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleArticleCategoryAssignmentRepository extends AuditRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'a.id AS articleId';
		$fields[] = 'a.name AS articleName';
		$fields[] = 'a.subname AS articleSubname';
		
		$fields[] = 'ac.id AS articleCategoryId';
		$fields[] = 'ac.name AS articleCategoryName';
		$fields[] = 'ac.subname AS articleCategorySubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Article::class, 'a', Join::WITH, 'a.id = e.article');
		$builder->innerJoin(ArticleCategory::class, 'ac', Join::WITH, 'ac.id = e.articleCategory');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ArticleArticleCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.article', $filter->getArticles());
		$this->addArrayWhere($builder, $where, 'e.articleCategory', $filter->getArticleCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('a.subname', 'ASC');
		$builder->addOrderBy('ac.name', 'ASC');
		$builder->addOrderBy('ac.subname', 'ASC');
	}

	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
}
