<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Form\Filter\Admin\Main\NewsletterUserFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class NewsletterUserFilterTypeTest extends BaseEntityFilterTypeTest {
		
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
	
	const SUBSCRIBED_FALSE = 0;
	const SUBSCRIBED_TRUE = 1;
	const SUBSCRIBED_ALL = 2;
	const SUBSCRIBED_CHOICES = [self::SUBSCRIBED_FALSE, self::SUBSCRIBED_TRUE, self::SUBSCRIBED_ALL];
	const SUBSCRIBED_SELECTED = self::SUBSCRIBED_TRUE;
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterUserFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		$this->assertSame(self::SUBSCRIBED_SELECTED, $entity->getInfomarket());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		$data['subscribed'] = self::SUBSCRIBED_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		$options[self::getChoicesName('subscribed')] = self::SUBSCRIBED_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterUserFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterUserFilter();
	}
}