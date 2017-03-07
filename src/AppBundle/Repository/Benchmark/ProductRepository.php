<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Category;
use AppBundle\Entity\BenchmarkField;

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
		
		$filterFields = $filter->getFilterFields();
		foreach ($filterFields as $filterField) {
			$value = $filterField['value'];
			if($value) {
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
							$where->add($expr->in('e.' . $valueName, $value));
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
