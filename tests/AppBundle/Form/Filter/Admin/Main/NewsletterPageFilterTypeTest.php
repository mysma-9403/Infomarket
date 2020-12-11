<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\NewsletterPageFilter;
use AppBundle\Form\Filter\Admin\Main\NewsletterPageFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class NewsletterPageFilterTypeTest extends SimpleFilterTypeTest {

	const NAME = '*name*';

	const NEWSLETTER_PAGE_TEMPLATE_1 = 401;

	const NEWSLETTER_PAGE_TEMPLATE_2 = 402;

	const NEWSLETTER_PAGE_TEMPLATE_3 = 403;

	const NEWSLETTER_PAGE_TEMPLATE_CHOICES = [self::NEWSLETTER_PAGE_TEMPLATE_1, 
			self::NEWSLETTER_PAGE_TEMPLATE_2, self::NEWSLETTER_PAGE_TEMPLATE_3];

	const NEWSLETTER_PAGE_TEMPLATE_SELECTED = [self::NEWSLETTER_PAGE_TEMPLATE_2, 
			self::NEWSLETTER_PAGE_TEMPLATE_3];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterPageFilter $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertArray(self::NEWSLETTER_PAGE_TEMPLATE_SELECTED, $entity->getNewsletterPageTemplates());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['newsletterPageTemplates'] = self::NEWSLETTER_PAGE_TEMPLATE_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
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