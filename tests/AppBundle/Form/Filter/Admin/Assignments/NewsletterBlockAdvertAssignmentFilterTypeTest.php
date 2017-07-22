<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockAdvertAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockAdvertAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class NewsletterBlockAdvertAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NEWSLETTER_BLOCK_1 = 101;
	const NEWSLETTER_BLOCK_2 = 102;
	const NEWSLETTER_BLOCK_3 = 103;
	const NEWSLETTER_BLOCK_CHOICES = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_2, self::NEWSLETTER_BLOCK_3];
	const NEWSLETTER_BLOCK_SELECTED = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_3];
	
	const ADVERT_1 = 201;
	const ADVERT_2 = 202;
	const ADVERT_3 = 203;
	const ADVERT_CHOICES = [self::ADVERT_1, self::ADVERT_2, self::ADVERT_3];
	const ADVERT_SELECTED = [self::ADVERT_2, self::ADVERT_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockAdvertAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::NEWSLETTER_BLOCK_SELECTED, $entity->getNewsletterBlocks());
		$this->assertArray(self::ADVERT_SELECTED, $entity->getAdverts());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterBlocks'] = self::NEWSLETTER_BLOCK_SELECTED;
		$data['adverts'] = self::ADVERT_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterBlocks')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('adverts')] = self::ADVERT_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockAdvertAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockAdvertAssignmentFilter();
	}
}