<?php

namespace Tests\AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Common\Base\SimpleFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use Tests\AppBundle\Form\Base\FilterTypeTest;

abstract class BaseFilterTypeTest extends FilterTypeTest {
	
	// const NAME = '*name*';
	
	// const INFOMARKET_FALSE = 0;
	// const INFOMARKET_TRUE = 1;
	// const INFOMARKET_ALL = 2;
	// const INFOMARKET_CHOICES = [self::INFOMARKET_FALSE, self::INFOMARKET_TRUE, self::INFOMARKET_ALL];
	// const INFOMARKET_SELECTED = self::INFOMARKET_TRUE;
	
	// const INFOPRODUKT_FALSE = 0;
	// const INFOPRODUKT_TRUE = 1;
	// const INFOPRODUKT_ALL = 2;
	// const INFOPRODUKT_CHOICES = [self::INFOPRODUKT_FALSE, self::INFOPRODUKT_TRUE, self::INFOPRODUKT_ALL];
	// const INFOPRODUKT_SELECTED = self::INFOPRODUKT_TRUE;
	
	// protected function assertEntity($entity) {
	// /** @var SimpleFilter $entity */
	// parent::assertEntity($entity);
	
	// $this->assertSame(self::NAME, $entity->getName());
	
	// $this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
	// $this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
	// }
	
	// protected function getFormData() {
	// $data = parent::getFormData();
	
	// $data['name'] = self::NAME;
	
	// $data['infomarket'] = self::INFOMARKET_SELECTED;
	// $data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
	
	// return $data;
	// }
	
	// protected function getFormOptions() {
	// $options = parent::getFormOptions();
	
	// $options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
	// $options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
	
	// return $options;
	// }
	
	// protected function getFormType() {
	// return SimpleFilterType::class;
	// }
	
	// protected function getEntity() {
	// return new SimpleFilter();
	// }
}