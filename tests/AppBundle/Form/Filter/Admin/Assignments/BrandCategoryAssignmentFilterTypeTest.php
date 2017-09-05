<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\BrandCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\BrandCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class BrandCategoryAssignmentFilterTypeTest extends BaseFilterTypeTest {
		
	const BRAND_1 = 101;
	const BRAND_2 = 102;
	const BRAND_3 = 103;
	const BRAND_CHOICES = [self::BRAND_1, self::BRAND_2, self::BRAND_3];
	const BRAND_SELECTED = [self::BRAND_1, self::BRAND_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var BrandCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::BRAND_SELECTED, $entity->getBrands());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
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
		return BrandCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new BrandCategoryAssignmentFilter();
	}
}