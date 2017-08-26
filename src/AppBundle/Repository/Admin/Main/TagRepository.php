<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Filter\Admin\Main\TagFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class TagRepository extends SimpleEntityRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var TagFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		
		return $where;
	}
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
	
		$fields[] = 'e.name';
	
		return $fields;
	}
	
	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
	
		$fields[] = $item['name'];
	
		return $fields;
	}

	public function findItemsByNames($names) {
		return $this->queryItemsByNames($names)->getScalarResult();
	}

	protected function queryItemsByNames($names) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name');
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->orX();
		foreach ($names as $name) {
			$where->add($expr->eq('LOWER (e.name)', $expr->literal($name)));
		}
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findAssignedIds($articleId, $ids) {
		$items = $this->queryAssignedIds($articleId, $ids)->getScalarResult();
		return $this->getIds($items);
	}

	protected function queryAssignedIds($articleId, $ids) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('IDENTITY (e.tag) AS id');
		$builder->from(ArticleTagAssignment::class, "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->in('e.article', $articleId));
		$where->add($expr->in('e.tag', $ids));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Tag::class;
	}
}
