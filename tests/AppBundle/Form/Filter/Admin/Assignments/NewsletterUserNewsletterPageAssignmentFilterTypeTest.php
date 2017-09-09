<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class NewsletterUserNewsletterPageAssignmentSimpleFilterTypeTest extends SimpleFilterTypeTest {

	const NEWSLETTER_USER_1 = 101;

	const NEWSLETTER_USER_2 = 102;

	const NEWSLETTER_USER_3 = 103;

	const NEWSLETTER_USER_CHOICES = [self::NEWSLETTER_USER_1, self::NEWSLETTER_USER_2, 
			self::NEWSLETTER_USER_3];

	const NEWSLETTER_USER_SELECTED = [self::NEWSLETTER_USER_1, self::NEWSLETTER_USER_3];

	const NEWSLETTER_PAGE_1 = 201;

	const NEWSLETTER_PAGE_2 = 202;

	const NEWSLETTER_PAGE_3 = 203;

	const NEWSLETTER_PAGE_CHOICES = [self::NEWSLETTER_PAGE_1, self::NEWSLETTER_PAGE_2, 
			self::NEWSLETTER_PAGE_3];

	const NEWSLETTER_PAGE_SELECTED = [self::NEWSLETTER_PAGE_2, self::NEWSLETTER_PAGE_3];

	const STATE_1 = 31;

	const STATE_2 = 32;

	const STATE_3 = 33;

	const STATE_CHOICES = [self::STATE_1, self::STATE_2, self::STATE_3];

	const STATE_SELECTED = [self::STATE_2, self::STATE_3];

	protected function assertEntity($entity) {
		/** @var NewsletterUserNewsletterPageAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::NEWSLETTER_USER_SELECTED, $entity->getNewsletterUsers());
		$this->assertArray(self::NEWSLETTER_PAGE_SELECTED, $entity->getNewsletterPages());
		
		$this->assertArray(self::STATE_SELECTED, $entity->getStates());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['newsletterUsers'] = self::NEWSLETTER_USER_SELECTED;
		$data['newsletterPages'] = self::NEWSLETTER_PAGE_SELECTED;
		
		$data['states'] = self::STATE_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterUsers')] = self::NEWSLETTER_USER_CHOICES;
		$options[self::getChoicesName('newsletterPages')] = self::NEWSLETTER_PAGE_CHOICES;
		
		$options[self::getChoicesName('states')] = self::STATE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return NewsletterUserNewsletterPageAssignmentFilterType::class;
	}

	protected function getEntity() {
		return new NewsletterUserNewsletterPageAssignmentFilter();
	}
}