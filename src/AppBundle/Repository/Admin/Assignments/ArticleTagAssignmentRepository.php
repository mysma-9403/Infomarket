<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\ArticleTagAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\Tag;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleTagAssignmentRepository extends SimpleRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'a.id AS articleId';
		$fields[] = 'a.name AS articleName';
		$fields[] = 'a.subname AS articleSubname';
		
		$fields[] = 't.id AS tagId';
		$fields[] = 't.name AS tagName';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Article::class, 'a', Join::WITH, 'a.id = e.article');
		$builder->innerJoin(Tag::class, 't', Join::WITH, 't.id = e.tag');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ArticleTagAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.article', $filter->getArticles());
		$this->addArrayWhere($builder, $where, 'e.tag', $filter->getTags());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('a.subname', 'ASC');
		$builder->addOrderBy('t.name', 'ASC');
	}

	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}
