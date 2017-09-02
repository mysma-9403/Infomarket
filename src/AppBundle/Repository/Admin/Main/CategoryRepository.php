<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Common\Main\CategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends ImageEntityRepository {

	protected function getItemSelectFields(QueryBuilder &$builder) {
		$fields = parent::getItemSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		/** @var CategoryFilter $filter */
		
		$builder->innerJoin(Category::class, 'p', Join::WITH, 'p.id = e.parent');
		
		if (count($filter->getBranches()) > 0) {
			$builder->leftJoin(BranchCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.category');
		}
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		$fields[] = 'e.featured';
		$fields[] = 'e.preleaf';
		
		$fields[] = 'p.id AS parentId';
		$fields[] = 'p.name AS parentName';
		$fields[] = 'p.subname AS parentSubname';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var CategoryFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		$this->addStringWhere($builder, $where, 'e.subname', $filter->getSubname());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		$this->addBooleanWhere($builder, $where, 'e.featured', $filter->getFeatured());
		$this->addBooleanWhere($builder, $where, 'e.preleaf', $filter->getPreleaf());
		
		$this->addArrayWhere($builder, $where, 'e.parent', $filter->getParents());
		$this->addArrayWhere($builder, $where, 'bca.branch', $filter->getBranches());
		
		return $where;
	}

	protected function buildFilterJoins(QueryBuilder &$builder) {
		parent::buildFilterJoins($builder);
		
		$builder->leftJoin(Category::class, 'p', Join::WITH, 'p.id = e.parent');
	}

	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		$fields[] = 'p.name AS parentName';
		$fields[] = 'p.subname AS parentSubname';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		$fields[] = $item['subname'];
		if (key_exists('parentName', $item) && $item['parentName']) {
			$fields[] = '(' . $item['parentName'];
			$fields[] = $item['parentSubname'] . ')';
		}
		
		return $fields;
	}

	public function findTreeItems() {
		$items = $this->queryTreeItems()->getScalarResult();
		
		$rootItems = $this->getRootItems($items);
		
		$index = 0;
		$size = count($rootItems);
		for ($i = 0; $i < $size; $i ++) {
			$rootItem = $rootItems[$i];
			$rootItems[$i] = $this->assignChildren($rootItem, $items, $index);
		}
		
		return $rootItems;
	}

	protected function queryTreeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, IDENTITY(e.parent) AS parent, e.name, e.subname, e.infomarket, e.infoprodukt, e.featured, e.preleaf");
		$builder->from($this->getEntityType(), "e");
		
		$builder->orderBy('e.treePath', 'ASC');
		
		return $builder->getQuery();
	}

	public function findChildrenIds($categoryId, $rootId) {
		$items = $this->queryChildrenIds($categoryId, $rootId)->getScalarResult();
		return $this->getIds($items);
	}

	protected function queryChildrenIds($categoryId, $rootId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->like('e.treePath', $expr->literal('%-' . $categoryId . '#%')));
		$where->add($expr->neq('e.id', $categoryId));
		$where->add($expr->neq('e.rootId', $rootId));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function setRootId(array $items, $rootId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.rootId', $rootId);
		$builder->where($builder->expr()->in('e.id', $items));
		
		$builder->getQuery()->execute();
	}

	public function findFilterItemsByProduct($productId) {
		$items = $this->queryFilterItemsByProduct($productId)->getScalarResult();
		return $this->getFilterItems($items);
	}

	protected function queryFilterItemsByProduct($productId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'pca.category = e.id');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($expr->eq('pca.product', $productId));
		
		$builder->where($where);
		
		$builder->orderBy('e.name', 'ASC');
		$builder->orderBy('e.subname', 'ASC');
		
		return $builder->getQuery();
	}

	public function findBenchmarkItems() {
		return $this->queryBenchmarkItems()->getScalarResult();
	}

	protected function queryBenchmarkItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.preleaf', 0));
		$where->add($expr->eq('e.benchmark', 1));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Category::class;
	}
}
