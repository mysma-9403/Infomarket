<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkEnum;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends BaseRepository {

	protected function getItemSelectFields(QueryBuilder &$builder) {
		return ['e.id', 'e.name', 'b.name AS brandName'];
	}

	protected function buildItemJoins(QueryBuilder &$builder) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	}

	public function findFilterItemsByValue($categoryId, $valueName) {
		$items = $this->queryFilterItemsByValue($categoryId, $valueName)->getScalarResult();
		return $this->getFilterItemsFromValues($items, $valueName);
	}

	protected function queryFilterItemsByValue($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("pv." . $valueName);
		$builder->distinct();
		
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('pv.' . $valueName, 'ASC');
		
		return $builder->getQuery();
	}

	protected function getFilterItemsFromValues(array $items, $valueName) {
		$result = array();
		
		foreach ($items as $item) {
			$multivalue = $item[$valueName];
			
			$temp = $multivalue;
			while (true) {
				$start = strpos($temp, '(');
				if ($start == false)
					break;
				$end = strpos($temp, ')');
				if ($end == false)
					break;
				
				$substr = substr($temp, $start, $end - $start);
				$replace = str_replace(',', '#', $substr);
				
				$temp = substr($temp, $end + 1);
				
				$multivalue = str_replace($substr, $replace, $multivalue);
			}
			
			$values = explode(',', $multivalue);
			
			foreach ($values as $value) {
				if ($value && strlen($value) > 0) {
					$value = trim($value);
					$value = str_replace('#', ',', $value);
					$result[$value] = $value;
				}
			}
		}
		
		return $result;
	}

	public function findMinMaxValues($categoryId, $valueName) {
		return $this->queryMinMaxValues($categoryId, $valueName)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryMinMaxValues($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$value = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select($expr->min($value) . ' AS vmin', $expr->max($value) . ' AS vmax');
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findMinMaxAvgValues($categoryId, $valueName) {
		return $this->queryMinMaxAvgValues($categoryId, $valueName)->getSingleResult(
				AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryMinMaxAvgValues($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$value = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select($expr->min($value) . ' AS vmin', $expr->max($value) . ' AS vmax', 
				$expr->avg($value) . ' AS vavg');
		
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findMaxEnumValue($categoryId, $valueName) {
		try {
			return $this->queryMaxEnumValue($categoryId, $valueName)->getSingleScalarResult();
		} catch (NoResultException $ex) {
			return 1;
		}
	}

	protected function queryMaxEnumValue($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select("SUM(be.value) AS value");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		$builder->leftJoin(BenchmarkEnum::class, 'be', Join::WITH, 
				'pv.' . $valueName . ' LIKE CONCAT(\'%\', be.name, \'%\')');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull('pv.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->groupBy('e.id');
		
		$builder->orderBy('value', 'DESC');
		$builder->setMaxResults(1);
		
		return $builder->getQuery();
	}

	public function findMinEnumValue($categoryId, $valueName) {
		try {
			return $this->queryMinEnumValue($categoryId, $valueName)->getSingleScalarResult();
		} catch (NoResultException $ex) {
			return 0;
		}
	}

	protected function queryMinEnumValue($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select("SUM(be.value) AS value");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		$builder->leftJoin(BenchmarkEnum::class, 'be', Join::WITH, 
				'pv.' . $valueName . ' LIKE CONCAT(\'%\', be.name, \'%\')');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull('pv.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->groupBy('e.id');
		
		$builder->orderBy('value', 'ASC');
		$builder->setMaxResults(1);
		
		return $builder->getQuery();
	}

	public function findEnumValue($productId, $valueName) {
		return $this->queryEnumValue($productId, $valueName)->getSingleScalarResult();
	}

	protected function queryEnumValue($productId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select("SUM(be.value) AS value");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(BenchmarkEnum::class, 'be', Join::WITH, 
				'pv.' . $valueName . ' LIKE CONCAT(\'%\', be.name, \'%\')');
		
		$where = $expr->andX();
		$where->add($expr->eq('e.id', $productId));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findValueCounts($categoryId, $valueName) {
		return $this->queryValueCounts($categoryId, $valueName)->getScalarResult();
	}

	protected function queryValueCounts($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$value = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select($expr->count('e.id') . ' AS vcount', $value);
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->groupBy($value);
		
		return $builder->getQuery();
	}

	public function findAllValues($categoryId, $valueName) {
		return $this->queryAllValues($categoryId, $valueName)->getScalarResult();
	}

	protected function queryAllValues($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$value = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select('e.id', $value);
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy($value);
		
		return $builder->getQuery();
	}

	public function findEnumValues($categoryId, $valueName) {
		return $this->queryEnumValues($categoryId, $valueName)->getScalarResult();
	}

	protected function queryEnumValues($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$value = 'pv.' . $valueName;
		
		$builder->select($value);
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findItemsCount($categoryId, $valueName) {
		return $this->queryItemsCount($categoryId, $valueName)->getSingleScalarResult();
	}

	protected function queryItemsCount($categoryId, $valueName) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$value = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select($expr->count('e.id'));
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($value));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findBetterThanCount($categoryId, $valueName, $value, $betterThanType) {
		return $this->queryBetterThanCount($categoryId, $valueName, $value, $betterThanType)->getSingleScalarResult();
	}

	protected function queryBetterThanCount($categoryId, $valueName, $value, $betterThanType) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		// TODO dirty!!
		$valueName = ($valueName == 'price' ? 'e.' : 'pv.') . $valueName;
		
		$builder->select($expr->count('e.id'));
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull($valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		switch ($betterThanType) {
			case BenchmarkField::GT_BETTER_THAN_TYPE:
				$where->add($expr->gte($valueName, $value));
				break;
			case BenchmarkField::LT_BETTER_THAN_TYPE:
				$where->add($expr->lte($valueName, $value));
				break;
		}
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function findNeighbourItems($categoryId, $entry, $productValue, $fields, $limit) {
		return $this->queryNeighbourItems($categoryId, $entry, $productValue, $fields, $limit)->getScalarResult();
	}

	/**
	 *
	 * @param unknown $categoryId        	
	 * @param Product $entry        	
	 * @param unknown $fields        	
	 * @param unknown $limit        	
	 */
	protected function queryNeighbourItems($categoryId, $entry, $productValue, $fields, $limit) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$selectFields = array();
		
		$selectFields[] = 'e.id';
		
		$selectFields[] = 'e.name';
		$selectFields[] = 'e.custom';
		
		$selectFields[] = 'e.image';
		$selectFields[] = 'e.mimeType';
		
		$selectFields[] = 'b.id AS brandId';
		$selectFields[] = 'b.name AS brandName';
		
		$selectFields[] = 'c.id AS categoryId';
		$selectFields[] = 'c.name AS categoryName';
		$selectFields[] = 'c.subname AS categorySubname';
		
		$selectFields[] = 'e.price';
		
		$distanceFields = array();
		
		foreach ($fields as $field) {
			$valueField = $field['valueField'];
			$selectField = 'pv.' . $valueField;
			$selectFields[] = $selectField;
			$weight = $field['compareWeight'];
			$min = key_exists('min', $field) ? $field['min'] : null;
			$max = key_exists('max', $field) ? $field['max'] : null;
			if ($weight > 0 && $min && $max > $min) {
				$norm = $max - $min;
				$value = $weight / $norm;
				$diff = $expr->abs($expr->diff($selectField, $productValue->offsetGet($valueField)));
				$distanceFields[] = $expr->prod($value, $diff);
			}
		}
		if (count($distanceFields) > 0) {
			$selectFields[] = join(' + ', $distanceFields) . ' AS distance';
		}
		
		$builder->select($selectFields);
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		$where->add($expr->neq('e.id', $entry->getId()));
		
		foreach ($fields as $field) {
			$valueField = $field['valueField'];
			$selectField = 'pv.' . $valueField;
			$weight = $field['compareWeight'];
			if ($weight > 0) {
				$where->add($expr->isNotNull($selectField));
			}
		}
		
		$builder->where($where);
		
		if (count($distanceFields) > 0) {
			$builder->orderBy('distance');
		}
		
		$builder->setMaxResults($limit);
		
		return $builder->getQuery();
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		/** @var ProductFilter $filter */
		
		if (! $filter->getBenchmarkQuery()) {
			$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
			$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		}
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		/** @var ProductFilter $filter */
		
		$fields[] = 'e.name';
		$fields[] = 'e.image';
		$fields[] = 'e.mimeType';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		if (! $filter->getBenchmarkQuery()) {
			$fields[] = 'c.id AS categoryId';
			$fields[] = 'c.name AS categoryName';
			$fields[] = 'c.subname AS categorySubname';
		}
		
		$fields[] = 'e.price';
		
		$showFields = $filter->getShowFields();
		foreach ($showFields as $showField) {
			$fields[] = 'pv.' . $showField['valueField'];
		}
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ProductFilter $filter */
		
		$expr = $builder->expr();
		
		if ($filter->getBenchmarkQuery()) {
			$where->add($expr->eq('e.benchmarkQuery', $filter->getBenchmarkQuery()));
		} else {
			$where->add($expr->isNull('e.benchmarkQuery'));
			
			$this->addStringWhere($builder, $where, 'e.name', $filter->getName(), true);
			
			$this->addArrayWhere($builder, $where, 'e.brand', $filter->getBrands());
			
			if (count($filter->getCategories()) > 0) {
				$where->add($expr->in('pca.category', $filter->getCategories()));
			} else {
				$where->add(
						$expr->like('c.treePath', 
								$builder->expr()->literal('%-' . $filter->getContextCategory() . '#%')));
			}
			
			if ($filter->getMinPrice()) {
				$where->add($expr->gte('e.price', $filter->getMinPrice()));
			}
			if ($filter->getMaxPrice()) {
				$where->add($expr->lte('e.price', $filter->getMaxPrice()));
			}
			
			$filterFields = $filter->getFilterFields();
			foreach ($filterFields as $filterField) {
				$value = $filterField['value'];
				if ($value != null) {
					$valueName = $filterField['valueField'];
					switch ($filterField['fieldType']) {
						case BenchmarkField::DECIMAL_FIELD_TYPE:
						case BenchmarkField::INTEGER_FIELD_TYPE:
							if ($value['min']) {
								$where->add($expr->gte('pv.' . $valueName, $value['min']));
							}
							if ($value['max']) {
								$where->add($expr->lte('pv.' . $valueName, $value['max']));
							}
							break;
						case BenchmarkField::BOOLEAN_FIELD_TYPE:
							if ($value != Filter::ALL_VALUES) {
								$where->add($expr->eq('pv.' . $valueName, $value));
							}
							break;
						case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
							$where->add($expr->in('pv.' . $valueName, $value));
							break;
						case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
							$or = $expr->orX();
							foreach ($value as $subvalue) {
								$or->add($expr->like('pv.' . $valueName, $expr->literal('%' . $subvalue . '%')));
							}
							$where->add($or);
							break;
						default:
							$where->add(
									$this->buildStringsExpression($builder, 'pv.' . $valueName, $value, true));
							break;
					}
				}
			}
		}
		
		return $where;
	}

	public function findBestItem($categoryId) {
		return $this->queryBestItem($categoryId)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryBestItem($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id');
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		$builder->innerJoin(ProductNote::class, 'pn', Join::WITH, 'pn.productCategoryAssignment = pca.id');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull('pn.overalNote'));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('pn.overalNote', 'DESC');
		$builder->setMaxResults(1);
		
		return $builder->getQuery();
	}

	public function findWorstItem($categoryId) {
		return $this->queryWorstItem($categoryId)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryWorstItem($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id');
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		$builder->innerJoin(ProductNote::class, 'pn', Join::WITH, 'pn.productCategoryAssignment = pca.id');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($expr->isNotNull('pn.overalNote'));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('pn.overalNote', 'ASC');
		$builder->setMaxResults(1);
		
		return $builder->getQuery();
	}

	public function findAllMinMaxValues($categoryId) {
		return $this->queryAllMinMaxValues($categoryId)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryAllMinMaxValues($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$selectFields = [];
		for ($i = 1; $i <= 30; $i ++) {
			$selectFields[] = $expr->min('pv.decimal' . $i) . ' AS decimalMin' . $i;
			$selectFields[] = $expr->max('pv.decimal' . $i) . ' AS decimalMax' . $i;
			
			$selectFields[] = $expr->min('pv.integer' . $i) . ' AS integerMin' . $i;
			$selectFields[] = $expr->max('pv.integer' . $i) . ' AS integerMax' . $i;
			
			$selectFields[] = $expr->min('ps.stringScore' . $i) . ' AS stringMin' . $i;
			$selectFields[] = $expr->max('ps.stringScore' . $i) . ' AS stringMax' . $i;
		}
		
		$builder->select($selectFields);
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(ProductValue::class, 'pv', Join::WITH, 'pca.id = pv.productCategoryAssignment');
		$builder->innerJoin(ProductScore::class, 'ps', Join::WITH, 'pca.id = ps.productCategoryAssignment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Product::class;
	}
}
