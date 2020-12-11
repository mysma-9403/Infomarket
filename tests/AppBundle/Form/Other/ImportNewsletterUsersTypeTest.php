<?php

namespace Tests\AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Form\Other\ImportNewsletterUsersType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class ImportNewsletterUsersTypeTest extends BaseTypeTest {

	const IMPORT_FILE = 'c:/test/file/import.csv';

	const NEWSLETTER_GROUP_1 = 101;

	const NEWSLETTER_GROUP_2 = 102;

	const NEWSLETTER_GROUP_3 = 103;

	const NEWSLETTER_GROUP_SELECTED = [self::NEWSLETTER_GROUP_2, self::NEWSLETTER_GROUP_3];

	const NEWSLETTER_GROUP_CHOICES = [self::NEWSLETTER_GROUP_1, self::NEWSLETTER_GROUP_2, 
			self::NEWSLETTER_GROUP_3];

	protected function assertEntity($entity) {
		/** @var ImportNewsletterUsers $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::IMPORT_FILE, $entity->getImportFile());
		
		$this->assertArray(self::NEWSLETTER_GROUP_SELECTED, $entity->getNewsletterGroups());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['importFile'] = self::IMPORT_FILE;
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
		return ImportNewsletterUsersType::class;
	}

	protected function getEntity() {
		return new ImportNewsletterUsers();
	}
}