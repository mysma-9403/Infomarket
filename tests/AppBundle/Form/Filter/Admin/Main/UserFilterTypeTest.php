<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\UserFilter;
use AppBundle\Form\Filter\Admin\Main\UserFilterType;
use Tests\AppBundle\Form\Base\FilterTypeTest;

class UserFilterTypeTest extends FilterTypeTest {
		
	const USERNAME = '*username*';
	const FORENAME = '*forename*';
	const SURNAME = '*surname*';
	
	
	
	protected function assertEntity($entity) {
		/** @var UserFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::USERNAME, $entity->getUsername());
		$this->assertSame(self::FORENAME, $entity->getForename());
		$this->assertSame(self::SURNAME, $entity->getSurname());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['username'] = self::USERNAME;
		$data['forename'] = self::FORENAME;
		$data['surname'] = self::SURNAME;
		
		return $data;
	}
	
	protected function getFormType() {
		return UserFilterType::class;
	}
	
	protected function getEntity() {
		return new UserFilter();
	}
}