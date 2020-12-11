<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends BaseRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add('e.parent IS NULL');
		
		$builder->where($where);
		
		return $where;
	}

	public function findContextChildren($categoryId) {
		$items = $this->queryContextChildren($categoryId)->getScalarResult();
		return $this->getIds($items);
	}

	protected function queryContextChildren($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $builder->expr()->andX();
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->like('e.treePath', $expr->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findContextParents($urlSlug) {
		$treePath = $this->queryContextTreePath($urlSlug)->getSingleResult(
				AbstractQuery::HYDRATE_SINGLE_SCALAR);
		return $this->getContextParents($treePath);
	}

	protected function queryContextTreePath($urlSlug) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.treePath");
		$builder->from($this->getEntityType(), "e");

		if ((int) $urlSlug !== 0) {
            $expr = $builder->expr();
            $builder->where($expr->eq('e.id', $urlSlug));
        } else {
            $builder->where('e.slugUrl = :urlSlug')->setParameter('urlSlug', $urlSlug);
        }
		return $builder->getQuery();
	}

	protected function getContextParents($treePath) {
		$items = array();
		
		$parts = explode('#', $treePath);
		foreach ($parts as $part) {
			$index = strrpos($part, '-');
			$id = substr($part, $index + 1);
			$items[] = $id;
		}

		return $items;
	}

	public function findMenuItems() {
		$items = $this->queryMenuItems()->getScalarResult();
		
		$rootItems = $this->getRootItemsWithLimit($items, 1000);
		
		$index = 0;
		$size = count($rootItems);
		for ($i = 0; $i < $size; $i ++) {
			$rootItem = $rootItems[$i];
			$rootItems[$i] = $this->assignChildrenWithLimit($rootItem, $items, $index, 1000);
		}

		return $rootItems;
	}

	protected function queryMenuItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, IDENTITY(e.parent) AS parent, e.preleaf, e.name, e.subname, e.iconImage, e.slugUrl");
		$builder->from($this->getEntityType(), "e");
		
		$builder->leftJoin(Category::class, 'p', Join::WITH, 'p.id = e.parent');
		$builder->leftJoin(Category::class, 'pp', Join::WITH, 'pp.id = p.parent');
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add('(e.parent IS NULL OR p.preleaf = 0)');
		$where->add('(p.parent IS NULL OR pp.preleaf = 0)');
		
		$builder->where($where);
		
		$builder->orderBy('e.treePath', 'ASC');

		return $builder->getQuery();
	}

	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}

	protected function queryHomeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical, e.featuredImage, e.rootId, e.slugUrl");
		$builder->from($this->getEntityType(), "e");
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add($builder->expr()->eq('e.preleaf', 1));
		
		$builder->where($where);

		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
		
		$builder->setMaxResults(12);
		
		return $builder->getQuery();
	}

	public function findSliderMainCategories()
    {
        $builder = new QueryBuilder($this->getEntityManager());

        $builder->select("e.id, e.name, e.subname, e.image, e.vertical, e.featuredImage, e.rootId, e.slugUrl");
        $builder->from($this->getEntityType(), "e");

        $where = $builder->expr()->andX();
        $where->add($builder->expr()->eq('e.infoprodukt', 1));
        $where->add($builder->expr()->eq('e.featured', 1));
        $where->add('(e.rootId IS NULL)');

        $builder->where($where);

        $builder->addOrderBy('e.name', 'ASC');
        $builder->addOrderBy('e.subname', 'ASC');

        return $builder->getQuery()->getScalarResult();
    }

	public function findSubcategories($category) {
		return $this->queryTopItems($category)->getScalarResult();
	}

	protected function queryTopItems($category) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name, e.subname, e.image, e.vertical');
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->eq('e.parent', $category));
		
		$builder->where($where);
		
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Category::class;
	}
}
