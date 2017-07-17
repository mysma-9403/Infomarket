<?php

namespace Tests\AppBundle\Form\Filter\Main;

use AppBundle\Filter\Admin\Main\ArticleCategoryFilter;
use AppBundle\Form\Filter\Admin\Main\ArticleCategoryFilterType;
use Tests\AppBundle\Form\Filter\Base\BaseEntityFilterTypeTest;

class ArticleCategoryFilterTypeTest extends BaseEntityFilterTypeTest {
		
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
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleCategoryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		$this->assertSame(self::FEATURED_SELECTED, $entity->getFeatured());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		$data['featured'] = self::FEATURED_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		$options[self::getChoicesName('featured')] = self::FEATURED_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleCategoryFilterType::class;
	}
	
	protected function getEntity() {
		return new ArticleCategoryFilter();
	}
}