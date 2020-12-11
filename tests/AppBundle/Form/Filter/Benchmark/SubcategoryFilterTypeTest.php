<?php

namespace Tests\AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class SubcategoryFilterTypeTest extends BaseTypeTest {

	const CATEGORY_1 = 101;

	const CATEGORY_2 = 102;

	const CATEGORY_3 = 103;

	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];

	const CATEGORY_SELECTED = self::CATEGORY_2;

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var SubcategoryFilter $entity */
		$this->assertSame(self::CATEGORY_SELECTED, $entity->getSubcategory());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['subcategory'] = self::CATEGORY_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('subcategory')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['submit'] = 'submit';
		
		return $actions;
	}

	protected function getFormType() {
		return SubcategoryFilterType::class;
	}

	protected function getEntity() {
		return new SubcategoryFilter();
	}
}