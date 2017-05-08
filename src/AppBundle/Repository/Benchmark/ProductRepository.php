<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends BaseRepository
{
	public function findFilterItemsByValue($categoryId, $valueName) {
		$items = $this->queryFilterItemsByValue($categoryId, $valueName)->getScalarResult();
		return $this->getFilterItemsFromValues($items, $valueName);
	}
	
	protected function queryFilterItemsByValue($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e." . $valueName);
		$builder->distinct();
		
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
	
		$builder->orderBy('e.' . $valueName, 'ASC');
			
		return $builder->getQuery();
	}
	
	protected function getFilterItemsFromValues(array $items, $valueName) {
		$result = array();
		
		foreach ($items as $item) {
			$multivalue = $item[$valueName];
			
			$temp = $multivalue;
			while(true) {
				$start = strpos($temp, '(');
				if($start == false) break;
				$end = strpos($temp, ')');
				if($end == false) break;
				
				$substr = substr($temp, $start, $end - $start);
				$replace = str_replace(',', '#', $substr);
				
				$temp = substr($temp, $end+1);
				
				$multivalue = str_replace($substr, $replace, $multivalue);
			}
			
			$values = explode(',', $multivalue);
			
			foreach ($values as $value) {
				if($value && strlen($value) > 0) {
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
	
	protected function queryMinMaxValues($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
		
		$builder->select($expr->min("e." . $valueName) . ' AS vmin', $expr->max("e." . $valueName) . ' AS vmax');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	public function findMinMaxAvgValues($categoryId, $valueName) {
		return $this->queryMinMaxAvgValues($categoryId, $valueName)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}
	
	protected function queryMinMaxAvgValues($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select($expr->min("e." . $valueName) . ' AS vmin', $expr->max("e." . $valueName) . ' AS vmax', $expr->avg("e." . $valueName) . ' AS vavg');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	public function findValueCounts($categoryId, $valueName) {
		return $this->queryValueCounts($categoryId, $valueName)->getScalarResult();
	}
	
	protected function queryValueCounts($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select($expr->count('e.id') . ' AS vcount', "e." . $valueName);
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
		
		$builder->groupBy("e." . $valueName);
			
		return $builder->getQuery();
	}
	
	public function findAllValues($categoryId, $valueName) {
		return $this->queryAllValues($categoryId, $valueName)->getScalarResult();
	}
	
	protected function queryAllValues($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id', "e." . $valueName);
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
		
		$builder->orderBy("e." . $valueName);
			
		return $builder->getQuery();
	}
	
	public function findEnumValues($categoryId, $valueName) {
		return $this->queryEnumValues($categoryId, $valueName)->getScalarResult();
	}
	
	protected function queryEnumValues($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select("e." . $valueName);
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	public function findItemsCount($categoryId, $valueName) {
		return $this->queryItemsCount($categoryId, $valueName)->getSingleScalarResult();
	}
	
	protected function queryItemsCount($categoryId, $valueName)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select($expr->count('e.id'));
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	public function findBetterThanCount($categoryId, $valueName, $value, $betterThanType) {
		return $this->queryBetterThanCount($categoryId, $valueName, $value, $betterThanType)->getSingleScalarResult();
	}
	
	protected function queryBetterThanCount($categoryId, $valueName, $value, $betterThanType)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select($expr->count('e.id'));
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->isNotNull('e.' . $valueName));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		switch($betterThanType) {
			case BenchmarkField::GT_BETTER_THAN_TYPE:
				$where->add($expr->gt('e.' . $valueName, $value));
				break;
			case BenchmarkField::GTE_BETTER_THAN_TYPE:
				$where->add($expr->gte('e.' . $valueName, $value));
				break;
			case BenchmarkField::LT_BETTER_THAN_TYPE:
				$where->add($expr->lt('e.' . $valueName, $value));
				break;
			case BenchmarkField::LTE_BETTER_THAN_TYPE:
				$where->add($expr->lte('e.' . $valueName, $value));
				break;
			case BenchmarkField::EQUAL_BETTER_THAN_TYPE:
				$where->add($expr->eq('e.' . $valueName, $value));
				break;
		}
		
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	
	
	
	public function findNeighbourItems($categoryId, $entry, $fields, $limit) {
		return $this->queryNeighbourItems($categoryId, $entry, $fields, $limit)->getScalarResult();
	}
	
	/**
	 * 
	 * @param unknown $categoryId
	 * @param Product $entry
	 * @param unknown $fields
	 * @param unknown $limit
	 */
	protected function queryNeighbourItems($categoryId, $entry, $fields, $limit)
	{
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$selectFields = array();
		
		$selectFields[] = 'e.id';
		
		$selectFields[] = 'e.name';
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
			$selectField = 'e.' . $valueField;
			$selectFields[] = $selectField;
			$weight = $field['compareWeight'];
			$min = key_exists('min', $field) ? $field['min'] : null;
			$max = key_exists('max', $field) ? $field['max'] : null;
			if($weight > 0 && $min && $max) {
				$norm = $max - $min;
				$value = $weight / $norm;
				$diff = $expr->abs($expr->diff($selectField, $entry->offsetGet($valueField)));
				$distanceFields[] = $expr->prod($value, $diff);
			}
		}
		if(count($distanceFields) > 0) {
			$selectFields[] = join(' + ', $distanceFields) . ' AS distance';
		}
		
		$builder->select($selectFields);
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	
		$where = $expr->andX();
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		$where->add($expr->neq('e.id', $entry->getId()));
		
		foreach ($fields as $field) {
			$valueField = $field['valueField'];
			$selectField = 'e.' . $valueField;
			$weight = $field['compareWeight'];
			if($weight > 0) {
				$where->add($expr->isNotNull($selectField));
			}
		}
		
		$builder->where($where);
		
		if(count($distanceFields) > 0) {
			$builder->orderBy('distance');
		}
		
		$builder->setMaxResults($limit);
			
		return $builder->getQuery();
	}
	
	
	
	
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
		$fields[] = 'e.image';
		$fields[] = 'e.mimeType';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		$fields[] = 'e.price';
		
		$showFields = $filter->getShowFields();
		foreach ($showFields as $showField) {
			$fields[] = 'e.' . BenchmarkField::getValueTypeDBName($showField['valueType']) . $showField['valueNumber'];
		}
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		$expr = $builder->expr();
		
		if(count($filter->getBrands()) > 0) {
			$where->add($expr->in('e.brand', $filter->getBrands()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($expr->in('pca.category', $filter->getCategories()));
		} else {
			$where->add($expr->like('c.treePath', $builder->expr()->literal('%-' . $filter->getContextCategory() . '#%')));
		}
		
		if($filter->getName()) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName(), true));
		}
		
		if($filter->getMinPrice()) {
			$where->add($expr->gte('e.price', $filter->getMinPrice()));
		}
		if($filter->getMaxPrice()) {
			$where->add($expr->lte('e.price', $filter->getMaxPrice()));
		}
		
		$filterFields = $filter->getFilterFields();
		foreach ($filterFields as $filterField) {
			$value = $filterField['value'];
			if($value != null) {
				$valueName = BenchmarkField::getValueTypeDBName($filterField['valueType']) . $filterField['valueNumber'];
				switch ($filterField['filterType']) {
					case BenchmarkField::DECIMAL_FILTER_TYPE:
					case BenchmarkField::INTEGER_FILTER_TYPE:
						if($value['min']) {
							$where->add($expr->gte('e.' . $valueName, $value['min']));
						}
						if($value['max']) {
							$where->add($expr->lte('e.' . $valueName, $value['max']));
						}
						break;
					case BenchmarkField::BOOLEAN_FILTER_TYPE:
						if($value != Filter::ALL_VALUES) {
							$where->add($expr->eq('e.' . $valueName, $value));
						}
						break;
					case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
						$where->add($expr->in('e.' . $valueName, $value));
						break;
					case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
						$or = $expr->orX();
						foreach ($value as $subvalue) {
							$or->add($expr->like('e.' . $valueName, $expr->literal('%' . $subvalue . '%')));
						}
						$where->add($or);
						break;
					default:
						$where->add($this->buildStringsExpression($builder, 'e.' . $valueName, $value, true));
						break;
				}
			}
		}
	
		return $where;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Product::class ;
	}
}
