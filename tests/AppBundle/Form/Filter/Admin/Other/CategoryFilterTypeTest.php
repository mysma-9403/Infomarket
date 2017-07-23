<?php

namespace Tests\AppBundle\Form\Filter\Admin\Other;

use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Form\Filter\Admin\Other\CategoryFilterType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class CategoryFilterTypeTest extends BaseTypeTest {
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = self::CATEGORY_2;
	
	
	
	protected function assertEntity($entity) {
		/** @var CategoryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertEquals(self::CATEGORY_SELECTED, $entity->getCategory());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['category'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['submit'] = 'submit';
		
		return $actions;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return CategoryFilterType::class;
	}
	
	protected function getEntity() {
		return new CategoryFilter();
	}
}