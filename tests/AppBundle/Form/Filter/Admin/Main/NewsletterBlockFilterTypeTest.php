<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\NewsletterBlockFilter;
use AppBundle\Form\Filter\Admin\Main\NewsletterBlockFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class NewsletterBlockFilterTypeTest extends BaseFilterTypeTest {
		
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
	
	const NEWSLETTER_PAGE_1 = 301;
	const NEWSLETTER_PAGE_2 = 302;
	const NEWSLETTER_PAGE_3 = 303;
	const NEWSLETTER_PAGE_CHOICES = [self::NEWSLETTER_PAGE_1, self::NEWSLETTER_PAGE_2, self::NEWSLETTER_PAGE_3];
	const NEWSLETTER_PAGE_SELECTED = [self::NEWSLETTER_PAGE_2, self::NEWSLETTER_PAGE_3];
	
	const NEWSLETTER_BLOCK_TEMPLATE_1 = 401;
	const NEWSLETTER_BLOCK_TEMPLATE_2 = 402;
	const NEWSLETTER_BLOCK_TEMPLATE_3 = 403;
	const NEWSLETTER_BLOCK_TEMPLATE_CHOICES = [self::NEWSLETTER_BLOCK_TEMPLATE_1, self::NEWSLETTER_BLOCK_TEMPLATE_2, self::NEWSLETTER_BLOCK_TEMPLATE_3];
	const NEWSLETTER_BLOCK_TEMPLATE_SELECTED = [self::NEWSLETTER_BLOCK_TEMPLATE_2, self::NEWSLETTER_BLOCK_TEMPLATE_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		
		$this->assertArray(self::NEWSLETTER_PAGE_SELECTED, $entity->getNewsletterPages());
		$this->assertArray(self::NEWSLETTER_BLOCK_TEMPLATE_SELECTED, $entity->getNewsletterBlockTemplates());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		
		$data['newsletterPages'] = self::NEWSLETTER_PAGE_SELECTED;
		$data['newsletterBlockTemplates'] = self::NEWSLETTER_BLOCK_TEMPLATE_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		
		$options[self::getChoicesName('newsletterPages')] = self::NEWSLETTER_PAGE_CHOICES;
		$options[self::getChoicesName('newsletterBlockTemplates')] = self::NEWSLETTER_BLOCK_TEMPLATE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockFilter();
	}
}