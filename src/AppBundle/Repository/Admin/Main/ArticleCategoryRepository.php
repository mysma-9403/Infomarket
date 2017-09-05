<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Filter\Common\Main\ArticleCategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleCategoryRepository extends ImageRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		$fields[] = 'e.featured';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleCategoryFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		$this->addStringWhere($builder, $where, 'e.subname', $filter->getSubname());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		$this->addBooleanWhere($builder, $where, 'e.featured', $filter->getFeatured());
		
		return $where;
	}

	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		parent::buildFilterOrderBy($builder);
		
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		$fields[] = $item['subname'];
		
		return $fields;
	}

	protected function getEntityType() {
		return ArticleCategory::class;
	}
}
