<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\ProductCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class ProductCategoryAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
	
	const BRAND_1 = 151;
	const BRAND_2 = 152;
	const BRAND_3 = 153;
	const BRAND_CHOICES = [self::BRAND_1, self::BRAND_2, self::BRAND_3];
	const BRAND_SELECTED = [self::BRAND_1, self::BRAND_3];
	
	const PRODUCT_1 = 101;
	const PRODUCT_2 = 102;
	const PRODUCT_3 = 103;
	const PRODUCT_CHOICES = [self::PRODUCT_1, self::PRODUCT_2, self::PRODUCT_3];
	const PRODUCT_SELECTED = [self::PRODUCT_1, self::PRODUCT_3];
	
	const SEGMENT_1 = 201;
	const SEGMENT_2 = 202;
	const SEGMENT_3 = 203;
	const SEGMENT_CHOICES = [self::SEGMENT_1, self::SEGMENT_2, self::SEGMENT_3];
	const SEGMENT_SELECTED = [self::SEGMENT_2, self::SEGMENT_3];
	
	const CATEGORY_1 = 301;
	const CATEGORY_2 = 302;
	const CATEGORY_3 = 303;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	const FEATURED_FALSE = 0;
	const FEATURED_TRUE = 1;
	const FEATURED_ALL = 2;
	const FEATURED_CHOICES = [self::FEATURED_FALSE, self::FEATURED_TRUE, self::FEATURED_ALL];
	const FEATURED_SELECTED = self::FEATURED_TRUE;
	
	
	
	protected function assertEntity($entity) {
		/** @var ProductCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::BRAND_SELECTED, $entity->getBrands());
		$this->assertArray(self::PRODUCT_SELECTED, $entity->getProducts());
		$this->assertArray(self::SEGMENT_SELECTED, $entity->getSegments());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
		
		$this->assertSame(self::FEATURED_SELECTED, $entity->getFeatured());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['brands'] = self::BRAND_SELECTED;
		$data['products'] = self::PRODUCT_SELECTED;
		$data['segments'] = self::SEGMENT_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		$data['featured'] = self::FEATURED_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('brands')] = self::BRAND_CHOICES;
		$options[self::getChoicesName('products')] = self::PRODUCT_CHOICES;
		$options[self::getChoicesName('segments')] = self::SEGMENT_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		$options[self::getChoicesName('featured')] = self::FEATURED_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ProductCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new ProductCategoryAssignmentFilter();
	}
}