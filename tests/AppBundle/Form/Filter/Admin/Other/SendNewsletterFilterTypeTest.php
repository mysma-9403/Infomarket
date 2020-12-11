<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Form\Filter\Admin\Other\SendNewsletterFilterType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class SendNewsletterFilterTypeTest extends BaseTypeTest {

	const EMBED_IMAGES = true;

	const FORCE_SEND = true;

	const NEWSLETTER_GROUP_1 = 11;

	const NEWSLETTER_GROUP_2 = 12;

	const NEWSLETTER_GROUP_3 = 13;

	const NEWSLETTER_GROUP_CHOICES = [self::NEWSLETTER_GROUP_1, self::NEWSLETTER_GROUP_2, 
			self::NEWSLETTER_GROUP_3];

	const NEWSLETTER_GROUP_SELECTED = [self::NEWSLETTER_GROUP_1, self::NEWSLETTER_GROUP_3];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var SendNewsletterFilter $entity */
		$this->assertSame(self::EMBED_IMAGES, $entity->getEmbedImages());
		$this->assertSame(self::FORCE_SEND, $entity->getForceSend());
		
		$this->assertArray(self::NEWSLETTER_GROUP_SELECTED, $entity->getNewsletterGroups());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['embedImages'] = self::EMBED_IMAGES;
		$data['forceSend'] = self::FORCE_SEND;
		
		$data['newsletterGroups'] = self::NEWSLETTER_GROUP_SELECTED;
		
		return $data;
	}

	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['submit'] = 'submit';
		
		return $actions;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterGroups')] = self::NEWSLETTER_GROUP_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return SendNewsletterFilterType::class;
	}

	protected function getEntity() {
		return new SendNewsletterFilter();
	}
}