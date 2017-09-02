<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\AdvertFilter;
use AppBundle\Form\Filter\Admin\Main\AdvertFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class AdvertFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NAME = '*name*';
	const LINK = '*link*';
	
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
	
	const CATEGORY_1 = 101;
	const CATEGORY_2 = 102;
	const CATEGORY_3 = 103;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	const LOCATION_1 = 11;
	const LOCATION_2 = 12;
	const LOCATION_3 = 13;
	const LOCATION_CHOICES = [self::LOCATION_1, self::LOCATION_2, self::LOCATION_3];
	const LOCATION_SELECTED = [self::LOCATION_1, self::LOCATION_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var AdvertFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::LINK, $entity->getLink());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
		$this->assertArray(self::LOCATION_SELECTED, $entity->getLocations());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		$data['link'] = self::LINK;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		
		$data['categories'] = self::CATEGORY_SELECTED;
		$data['locations'] = self::LOCATION_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		$options[self::getChoicesName('locations')] = self::LOCATION_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return AdvertFilterType::class;
	}
	
	protected function getEntity() {
		return new AdvertFilter();
	}
}