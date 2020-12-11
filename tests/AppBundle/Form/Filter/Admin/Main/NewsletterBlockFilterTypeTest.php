<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\NewsletterBlockFilter;
use AppBundle\Form\Filter\Admin\Main\NewsletterBlockFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class NewsletterBlockFilterTypeTest extends SimpleFilterTypeTest {

	const NAME = '*name*';

	const NEWSLETTER_PAGE_1 = 301;

	const NEWSLETTER_PAGE_2 = 302;

	const NEWSLETTER_PAGE_3 = 303;

	const NEWSLETTER_PAGE_CHOICES = [self::NEWSLETTER_PAGE_1, self::NEWSLETTER_PAGE_2, 
			self::NEWSLETTER_PAGE_3];

	const NEWSLETTER_PAGE_SELECTED = [self::NEWSLETTER_PAGE_2, self::NEWSLETTER_PAGE_3];

	const NEWSLETTER_BLOCK_TEMPLATE_1 = 401;

	const NEWSLETTER_BLOCK_TEMPLATE_2 = 402;

	const NEWSLETTER_BLOCK_TEMPLATE_3 = 403;

	const NEWSLETTER_BLOCK_TEMPLATE_CHOICES = [self::NEWSLETTER_BLOCK_TEMPLATE_1, 
			self::NEWSLETTER_BLOCK_TEMPLATE_2, self::NEWSLETTER_BLOCK_TEMPLATE_3];

	const NEWSLETTER_BLOCK_TEMPLATE_SELECTED = [self::NEWSLETTER_BLOCK_TEMPLATE_2, 
			self::NEWSLETTER_BLOCK_TEMPLATE_3];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterBlockFilter $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertArray(self::NEWSLETTER_PAGE_SELECTED, $entity->getNewsletterPages());
		$this->assertArray(self::NEWSLETTER_BLOCK_TEMPLATE_SELECTED, $entity->getNewsletterBlockTemplates());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['newsletterPages'] = self::NEWSLETTER_PAGE_SELECTED;
		$data['newsletterBlockTemplates'] = self::NEWSLETTER_BLOCK_TEMPLATE_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
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