<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class ArticleTagAssignmentRepository extends AuditRepository
{
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
		/** @var ArticleTagAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getArticles()) > 0) {
			$where->add($builder->expr()->in('e.article', $filter->getArticles()));
		}
	
		if(count($filter->getTags()) > 0) {
			$where->add($builder->expr()->in('e.tag', $filter->getTags()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('a.subname', 'ASC');
		$builder->addOrderBy('t.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleTagAssignment::class ;
	}
}
