<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\User;
use AppBundle\Filter\Common\Main\UserFilter;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Repository\Base\BaseRepository;

class UserRepository extends BaseRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.surname', 'ASC');
		$builder->addOrderBy('e.forename', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.email';
		$fields[] = 'e.username';
		$fields[] = 'e.surname';
		$fields[] = 'e.forename';
		$fields[] = 'e.pseudonym';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var UserFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.username', $filter->getUsername());
		$this->addStringWhere($builder, $where, 'e.surname', $filter->getSurname());
		$this->addStringWhere($builder, $where, 'e.forename', $filter->getForename());
		$this->addStringWhere($builder, $where, 'e.email', $filter->getEmail());
		
		return $where;
	}
	
	// ------------------------------
	//
	// ------------------------------
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('e.surname', 'ASC');
		$builder->addOrderBy('e.forename', 'ASC');
	}

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		
		$roles = $expr->orX();
		$roles->add($expr->like('e.roles', $expr->literal('%BENCHMARK%')));
		$roles->add($expr->like('e.roles', $expr->literal('%EDITOR%')));
		$roles->add($expr->like('e.roles', $expr->literal('%ADMIN%')));
		
		//TODO unlock when users are automatically added in registration form to proper role (BENCHMARK orEDITOR)
// 		$where->add($roles);
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.surname';
		$fields[] = 'e.forename';
		$fields[] = 'e.username';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['surname'];
		$fields[] = $item['forename'];
		$fields[] = '(' . $item['username'] . ')';
		
		return $fields;
	}

	protected function getEntityType() {
		return User::class;
	}
}
