<?php

namespace Tests\AppBundle\Form\Filter\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Base\BaseEntityFilterTypeTest;

class NewsletterUserNewsletterGroupAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NEWSLETTER_USER_1 = 101;
	const NEWSLETTER_USER_2 = 102;
	const NEWSLETTER_USER_3 = 103;
	const NEWSLETTER_USER_CHOICES = [self::NEWSLETTER_USER_1, self::NEWSLETTER_USER_2, self::NEWSLETTER_USER_3];
	const NEWSLETTER_USER_SELECTED = [self::NEWSLETTER_USER_1, self::NEWSLETTER_USER_3];
	
	const NEWSLETTER_GROUP_1 = 201;
	const NEWSLETTER_GROUP_2 = 202;
	const NEWSLETTER_GROUP_3 = 203;
	const NEWSLETTER_GROUP_CHOICES = [self::NEWSLETTER_GROUP_1, self::NEWSLETTER_GROUP_2, self::NEWSLETTER_GROUP_3];
	const NEWSLETTER_GROUP_SELECTED = [self::NEWSLETTER_GROUP_2, self::NEWSLETTER_GROUP_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterUserNewsletterGroupAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::NEWSLETTER_USER_SELECTED, $entity->getNewsletterUsers());
		$this->assertArray(self::NEWSLETTER_GROUP_SELECTED, $entity->getNewsletterGroups());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterUsers'] = self::NEWSLETTER_USER_SELECTED;
		$data['newsletterGroups'] = self::NEWSLETTER_GROUP_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterUsers')] = self::NEWSLETTER_USER_CHOICES;
		$options[self::getChoicesName('newsletterGroups')] = self::NEWSLETTER_GROUP_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterUserNewsletterGroupAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterUserNewsletterGroupAssignmentFilter();
	}
}