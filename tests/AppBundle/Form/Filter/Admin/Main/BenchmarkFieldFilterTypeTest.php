<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\BenchmarkFieldFilter;
use AppBundle\Form\Filter\Admin\Main\BenchmarkFieldFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class BenchmarkFieldFilterTypeTest extends BaseFilterTypeTest {
		
	const FIELD_NAME = '*fieldName*';
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	const FIELD_TYPE_1 = 101;
	const FIELD_TYPE_2 = 102;
	const FIELD_TYPE_3 = 103;
	const FIELD_TYPE_CHOICES = [self::FIELD_TYPE_1, self::FIELD_TYPE_2, self::FIELD_TYPE_3];
	const FIELD_TYPE_SELECTED = [self::FIELD_TYPE_2, self::FIELD_TYPE_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkFieldFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::FIELD_NAME, $entity->getFieldName());
		
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
		$this->assertArray(self::FIELD_TYPE_SELECTED, $entity->getFieldTypes());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['fieldName'] = self::FIELD_NAME;
		
		$data['categories'] = self::CATEGORY_SELECTED;
		$data['fieldTypes'] = self::FIELD_TYPE_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		$options[self::getChoicesName('fieldTypes')] = self::FIELD_TYPE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return BenchmarkFieldFilterType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkFieldFilter();
	}
}