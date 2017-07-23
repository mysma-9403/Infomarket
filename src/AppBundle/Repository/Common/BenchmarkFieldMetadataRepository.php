<?php

namespace AppBundle\Repository\Common;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BenchmarkFieldMetadataRepository extends EntityRepository
{	
	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueNumber, e.fieldType, e.fieldName, e.decimalPlaces, e.noteType, e.noteWeight, e.betterThanType, e.compareWeight");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
	
		$builder->where($where);
	
		$builder->orderBy('e.fieldNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
	
	
	
	public function findShowItemsByCategory($categoryId) {
		return $this->queryShowItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryShowItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueNumber, e.fieldType, e.fieldName, e.decimalPlaces, e.noteType, e.noteWeight, e.betterThanType, e.compareWeight");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
		$where->add($expr->eq('e.showField', 1));
	
		$builder->where($where);
	
		$builder->orderBy('e.fieldNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
	
	
	
	public function findFilterItemsByCategory($categoryId) {
		return $this->queryFilterItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryFilterItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueNumber, e.fieldType, e.filterName");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
		$where->add($expr->eq('e.showFilter', 1));
	
		$builder->where($where);
	
		$builder->orderBy('e.filterNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
	
	
	
	public function findNoteItemsByCategory($categoryId) {
		return $this->queryNoteItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryNoteItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueNumber, e.fieldType");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
		$where->add($expr->neq('e.noteType', BenchmarkField::NONE_NOTE_TYPE));
		$where->add($expr->gt('e.noteWeight', 0));
	
		$builder->where($where);
	
		$builder->orderBy('e.fieldNumber', 'ASC');
	
		return $builder->getQuery();
	}
	
	
	
	public function findNumberItemsByCategory($categoryId) {
		return $this->queryNumberItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryNumberItemsByCategory($categoryId)
	{
		return $this->queryItemsByTypesAndCategory($categoryId, [BenchmarkField::DECIMAL_FIELD_TYPE, BenchmarkField::INTEGER_FIELD_TYPE]);
	}
	
	public function findEnumItemsByCategory($categoryId) {
		return $this->queryEnumItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryEnumItemsByCategory($categoryId)
	{
		return $this->queryItemsByTypesAndCategory($categoryId, [BenchmarkField::SINGLE_ENUM_FIELD_TYPE, BenchmarkField::MULTI_ENUM_FIELD_TYPE]);
	}
	
	public function findBoolItemsByCategory($categoryId) {
		return $this->queryBoolItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryBoolItemsByCategory($categoryId)
	{
		return $this->queryItemsByTypesAndCategory($categoryId, [BenchmarkField::BOOLEAN_FIELD_TYPE]);
	}
	
	
	
	protected function queryItemsByTypesAndCategory($categoryId, $types)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueNumber, e.fieldType, e.fieldName, e.decimalPlaces");
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'e.category = c.id');
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.showField', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
		$where->add($expr->in('e.fieldType', $types));
	
		$builder->where($where);
	
		$builder->orderBy('e.fieldNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkField::class;
	}
}
