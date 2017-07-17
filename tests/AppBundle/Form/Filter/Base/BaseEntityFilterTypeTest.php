<?php

namespace Tests\AppBundle\Form\Filter\Base;


use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Tests\AppBundle\Form\Base\FilterTypeTest;

class BaseEntityFilterTypeTest extends FilterTypeTest {
	
	const CREATED_BY_1 = 101;
	const CREATED_BY_2 = 102;
	const CREATED_BY_3 = 103;
	const CREATED_BY_CHOICES = [self::CREATED_BY_1, self::CREATED_BY_2, self::CREATED_BY_3];
	const CREATED_BY_SELECTED = [self::CREATED_BY_1, self::CREATED_BY_3];
	
	const UPDATED_BY_1 = 101;
	const UPDATED_BY_2 = 102;
	const UPDATED_BY_3 = 103;
	const UPDATED_BY_CHOICES = [self::UPDATED_BY_1, self::UPDATED_BY_2, self::UPDATED_BY_3];
	const UPDATED_BY_SELECTED = [self::UPDATED_BY_1, self::UPDATED_BY_3];
	
	const CREATED_BEFORE = '10/01/2021 12:00';
	const CREATED_AFTER = '21/07/2014 12:00';
	
	const UPDATED_BEFORE = '11/11/2027 12:00';
	const UPDATED_AFTER = '05/02/2010 11:45';
	
	protected function assertEntity($entity) {
		/** @var AuditFilter $entity */
		parent::assertEntity($entity);
	
		$this->assertDateTime(self::CREATED_BEFORE, $entity->getCreatedBefore());
		$this->assertDateTime(self::CREATED_AFTER, $entity->getCreatedAfter());
		
		$this->assertDateTime(self::UPDATED_BEFORE, $entity->getUpdatedBefore());
		$this->assertDateTime(self::UPDATED_AFTER, $entity->getUpdatedAfter());
		
		$this->assertArray(self::CREATED_BY_SELECTED, $entity->getCreatedBy());
		$this->assertArray(self::UPDATED_BY_SELECTED, $entity->getUpdatedBy());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['createdBy'] = self::CREATED_BY_SELECTED;
		$data['updatedBy'] = self::UPDATED_BY_SELECTED;
		
		$data['createdBefore'] = self::CREATED_BEFORE;
		$data['createdAfter'] = self::CREATED_AFTER;
		
		$data['updatedBefore'] = self::UPDATED_BEFORE;
		$data['updatedAfter'] = self::UPDATED_AFTER;
	
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('createdBy')] = self::CREATED_BY_CHOICES;
		$options[self::getChoicesName('updatedBy')] = self::UPDATED_BY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return AdminFilterType::class;
	}
	
	protected function getEntity() {
		return new AuditFilter();
	}
}