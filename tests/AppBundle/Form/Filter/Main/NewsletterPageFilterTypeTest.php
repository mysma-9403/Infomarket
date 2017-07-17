<?php

namespace Tests\AppBundle\Form\Filter\Main;

use AppBundle\Filter\Admin\Main\NewsletterPageFilter;
use AppBundle\Form\Filter\Admin\Main\NewsletterPageFilterType;
use Tests\AppBundle\Form\Filter\Base\BaseEntityFilterTypeTest;

class NewsletterPageFilterTypeTest extends BaseEntityFilterTypeTest {
		
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
	
	const NEWSLETTER_PAGE_TEMPLATE_1 = 401;
	const NEWSLETTER_PAGE_TEMPLATE_2 = 402;
	const NEWSLETTER_PAGE_TEMPLATE_3 = 403;
	const NEWSLETTER_PAGE_TEMPLATE_CHOICES = [self::NEWSLETTER_PAGE_TEMPLATE_1, self::NEWSLETTER_PAGE_TEMPLATE_2, self::NEWSLETTER_PAGE_TEMPLATE_3];
	const NEWSLETTER_PAGE_TEMPLATE_SELECTED = [self::NEWSLETTER_PAGE_TEMPLATE_2, self::NEWSLETTER_PAGE_TEMPLATE_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterPageFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		
		$this->assertArray(self::NEWSLETTER_PAGE_TEMPLATE_SELECTED, $entity->getNewsletterPageTemplates());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		
		$data['newsletterPageTemplates'] = self::NEWSLETTER_PAGE_TEMPLATE_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		
		$options[self::getChoicesName('newsletterPageTemplates')] = self::NEWSLETTER_PAGE_TEMPLATE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterPageFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterPageFilter();
	}
}