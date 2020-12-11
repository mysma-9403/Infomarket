<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterBlockMagazineAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockMagazineAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class NewsletterBlockMagazineAssignmentSimpleFilterTypeTest extends SimpleFilterTypeTest {

	const NEWSLETTER_BLOCK_1 = 101;

	const NEWSLETTER_BLOCK_2 = 102;

	const NEWSLETTER_BLOCK_3 = 103;

	const NEWSLETTER_BLOCK_CHOICES = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_2, 
			self::NEWSLETTER_BLOCK_3];

	const NEWSLETTER_BLOCK_SELECTED = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_3];

	const MAGAZINE_1 = 201;

	const MAGAZINE_2 = 202;

	const MAGAZINE_3 = 203;

	const MAGAZINE_CHOICES = [self::MAGAZINE_1, self::MAGAZINE_2, self::MAGAZINE_3];

	const MAGAZINE_SELECTED = [self::MAGAZINE_2, self::MAGAZINE_3];

	protected function assertEntity($entity) {
		/** @var NewsletterBlockMagazineAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::NEWSLETTER_BLOCK_SELECTED, $entity->getNewsletterBlocks());
		$this->assertArray(self::MAGAZINE_SELECTED, $entity->getMagazines());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['newsletterBlocks'] = self::NEWSLETTER_BLOCK_SELECTED;
		$data['magazines'] = self::MAGAZINE_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterBlocks')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('magazines')] = self::MAGAZINE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return NewsletterBlockMagazineAssignmentFilterType::class;
	}

	protected function getEntity() {
		return new NewsletterBlockMagazineAssignmentFilter();
	}
}