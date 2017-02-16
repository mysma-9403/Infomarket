<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Main\UserFilter;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Repository\Base\BaseRepository;

class UserRepository extends BaseRepository
{
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.surname', 'ASC');
		$builder->addOrderBy('e.forename', 'ASC');
	}
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.username';
		$fields[] = 'e.surname';
		$fields[] = 'e.forename';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var UserFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		$expr = $builder->expr();
	
		if($filter->getUsername()) {
			$where->add($this->buildStringsExpression($builder, 'e.username', $filter->getUsername()));
		}
		
		if($filter->getSurname()) {
			$where->add($this->buildStringsExpression($builder, 'e.surname', $filter->getSurname()));
		}
		
		if($filter->getForename()) {
			$where->add($this->buildStringsExpression($builder, 'e.forename', $filter->getForename()));
		}
		
		$roles = $expr->orX();
		$roles->add($expr->like('e.roles', $expr->literal('%EDITOR%')));
		$roles->add($expr->like('e.roles', $expr->literal('%ADMIN%')));
	
		$where->add($roles);
	
		return $where;
	}
	
	
	
	//------------------------------
	//
	//------------------------------
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('e.surname', 'ASC');
		$builder->addOrderBy('e.forename', 'ASC');
	}
	
	
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		return ['e.id', 'e.surname', 'e.forename'];
	}
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		
		$roles = $expr->orX();
		$roles->add($expr->like('e.roles', $expr->literal('%EDITOR%')));
		$roles->add($expr->like('e.roles', $expr->literal('%ADMIN%')));
		
		$where->add($roles);
		
		return $where;
	}
	
	
	
	protected function getFilterItemKeyFields($item) {
		return [$item['id'], $item['surname'], $item['forename']];
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return User::class;
	}
}
