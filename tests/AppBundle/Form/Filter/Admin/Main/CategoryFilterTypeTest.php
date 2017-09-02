<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\CategoryFilter;
use AppBundle\Form\Filter\Admin\Main\CategoryFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class CategoryFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NAME = '*name*';
	const SUBNAME = '*subname*';
	
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
	
	const FEATURED_FALSE = 0;
	const FEATURED_TRUE = 1;
	const FEATURED_ALL = 2;
	const FEATURED_CHOICES = [self::FEATURED_FALSE, self::FEATURED_TRUE, self::FEATURED_ALL];
	const FEATURED_SELECTED = self::FEATURED_TRUE;
	
	const PRELEAF_FALSE = 0;
	const PRELEAF_TRUE = 1;
	const PRELEAF_ALL = 2;
	const PRELEAF_CHOICES = [self::PRELEAF_FALSE, self::PRELEAF_TRUE, self::PRELEAF_ALL];
	const PRELEAF_SELECTED = self::PRELEAF_TRUE;
	
	const BRANCH_1 = 101;
	const BRANCH_2 = 102;
	const BRANCH_3 = 103;
	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];
	const BRANCH_SELECTED = [self::BRANCH_2, self::BRANCH_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var CategoryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		$this->assertSame(self::FEATURED_SELECTED, $entity->getFeatured());
		$this->assertSame(self::PRELEAF_SELECTED, $entity->getPreleaf());
		
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getParents());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		$data['featured'] = self::FEATURED_SELECTED;
		$data['preleaf'] = self::PRELEAF_SELECTED;
		
		$data['branches'] = self::BRANCH_SELECTED;
		$data['parents'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		$options[self::getChoicesName('featured')] = self::FEATURED_CHOICES;
		$options[self::getChoicesName('preleaf')] = self::PRELEAF_CHOICES;
		
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
		$options[self::getChoicesName('parents')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return CategoryFilterType::class;
	}
	
	protected function getEntity() {
		return new CategoryFilter();
	}
}