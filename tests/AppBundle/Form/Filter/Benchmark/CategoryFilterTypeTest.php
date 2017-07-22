<?php

namespace Tests\AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class CategoryFilterTypeTest extends BaseTypeTest {
	
	const CATEGORY_1 = 101;
	const CATEGORY_2 = 102;
	const CATEGORY_3 = 103;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = self::CATEGORY_2;
	
	
	
	protected function assertEntity($entity) {
		/** @var CategoryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::CATEGORY_SELECTED, $entity->getCategory());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['category'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['submit'] = 'submit';
		
		return $actions;
	}
	
	protected function getFormType() {
		return CategoryFilterType::class;
	}
	
	protected function getEntity() {
		return new CategoryFilter();
	}
}