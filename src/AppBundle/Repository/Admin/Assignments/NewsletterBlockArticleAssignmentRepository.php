<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterBlockArticleAssignmentRepository extends AuditRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'nb.id AS newsletterBlockId';
		$fields[] = 'nb.name AS newsletterBlockName';
		$fields[] = 'nb.subname AS newsletterBlockSubname';
		
		$fields[] = 'a.id AS articleId';
		$fields[] = 'a.name AS articleName';
		$fields[] = 'a.subname AS articleSubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->innerJoin(Article::class, 'a', Join::WITH, 'a.id = e.article');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterBlockArticleAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.newsletterBlock', $filter->getNewsletterBlocks());
		$this->addArrayWhere($builder, $where, 'e.article', $filter->getArticles());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('nb.name', 'ASC');
		$builder->addOrderBy('nb.subname', 'ASC');
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('a.subname', 'ASC');
	}

	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}
