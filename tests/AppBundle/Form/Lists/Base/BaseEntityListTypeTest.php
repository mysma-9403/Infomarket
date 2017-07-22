<?php

namespace Tests\AppBundle\Form\Lists\Base;

use AppBundle\Entity\Lists\Base\BaseEntityList;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use Tests\AppBundle\Form\Base\ListTypeTest;

class BaseEntityListTypeTest extends ListTypeTest {
	
	const ENTRY_1 = 201;
	const ENTRY_2 = 202;
	const ENTRY_3 = 203;
	const ENTRY_CHOICES = [self::ENTRY_1, self::ENTRY_2, self::ENTRY_3];
	const ENTRY_SELECTED = [self::ENTRY_2, self::ENTRY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var BaseEntityList $entity */
		$this->assertArray(self::ENTRY_SELECTED, $entity->getEntries());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['entries'] = self::ENTRY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('entries')] = self::ENTRY_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return BaseEntityListType::class;
	}
	
	protected function getEntity() {
		return new BaseEntityList();
	}
}