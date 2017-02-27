<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleCategoryRepository extends BaseRepository
{
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		parent::buildFilterOrderBy($builder);
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.subname';
		
		return $fields;
	}
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}
	
	
	
	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['subname'];
		
		return $fields;
	}
	
	
	
	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}
	
	public function queryHomeItems()
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical");
		$builder->from($this->getEntityType(), "e");
	
		$builder->where($builder->expr()->eq('e.infoprodukt', 1));
	
		return $builder->getQuery();
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleCategory::class;
	}
}
