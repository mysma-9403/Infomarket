<?php

namespace Tests\AppBundle\Form\Other;

use AppBundle\Entity\Main\Other\ImportRatings;
use AppBundle\Form\Other\ImportRatingsType;
use Tests\AppBundle\Form\Base\BaseTypeTest;

class ImportRatingsTypeTest extends BaseTypeTest {
	
	const IMPORT_FILE = 'c:/test/file/import.csv';
	
	
	
	protected function assertEntity($entity) {
		/** @var ImportRatings $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::IMPORT_FILE, $entity->getImportFile());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['importFile'] = self::IMPORT_FILE;
		
		return $data;
	}
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
	
		$actions['submit'] = 'submit';
	
		return $actions;
	}
	
	protected function getFormType() {
		return ImportRatingsType::class;
	}
	
	protected function getEntity() {
		return new ImportRatings();
	}
}