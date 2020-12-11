<?php

namespace Tests\AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Form\Filter\Benchmark\CustomProductFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class CustomProductFilterTypeTest extends BaseFilterTypeTest {

	const NAME = '*name*';

	const BRAND_1 = 101;

	const BRAND_2 = 102;

	const BRAND_3 = 103;

	const BRAND_CHOICES = [self::BRAND_1, self::BRAND_2, self::BRAND_3];

	const BRAND_SELECTED = [self::BRAND_1, self::BRAND_3];

	const CATEGORY_1 = 11;

	const CATEGORY_2 = 12;

	const CATEGORY_3 = 13;

	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];

	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var CustomProductFilter $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertArray(self::BRAND_SELECTED, $entity->getBrands());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['brands'] = self::BRAND_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('brands')] = self::BRAND_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return CustomProductFilterType::class;
	}

	protected function getEntity() {
		return new CustomProductFilter();
	}
}