<?php

namespace Tests\AppBundle\Form\Filter\Main;

use AppBundle\Filter\Admin\Main\ProductFilter;
use AppBundle\Form\Filter\Admin\Main\ProductFilterType;
use Tests\AppBundle\Form\Filter\Base\BaseEntityFilterTypeTest;

class ProductFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NAME = '*name*';
	
	const INFOMARKET_FALSE = 0;
	const INFOMARKET_TRUE = 1;
	const INFOMARKET_ALL = 2;
	const INFOMARKET_CHOICES = [self::INFOMARKET_FALSE, self::INFOMARKET_TRUE, self::INFOMARKET_ALL];
	const INFOMARKET_SELECTED = self::INFOMARKET_TRUE;
	
	const INFOPRODUKT_FALSE = 0;
	const INFOPRODUKT_TRUE = 1;
	const INFOPRODUKT_ALL = 2;
	const INFOPRODUKT_CHOICES = [self::INFOPRODUKT_FALSE, self::INFOPRODUKT_TRUE, self::INFOPRODUKT_ALL];
	const INFOPRODUKT_SELECTED = self::INFOPRODUKT_TRUE;
	
	const BRAND_1 = 101;
	const BRAND_2 = 102;
	const BRAND_3 = 103;
	const BRAND_CHOICES = [self::BRAND_1, self::BRAND_2, self::BRAND_3];
	const BRAND_SELECTED = [self::BRAND_2, self::BRAND_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var ProductFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		
		$this->assertArray(self::BRAND_SELECTED, $entity->getBrands());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		
		$data['brands'] = self::BRAND_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		
		$options[self::getChoicesName('brands')] = self::BRAND_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ProductFilterType::class;
	}
	
	protected function getEntity() {
		return new ProductFilter();
	}
}