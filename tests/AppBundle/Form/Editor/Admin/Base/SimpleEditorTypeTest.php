<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\Simple;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;

class SimpleEditorTypeTest extends BaseEditorTypeTest {
	
	const NAME = 'Test name';
	const INFOMARKET = true;
	const INFOPRODUKT = true;
	
	protected function assertEntity($entity) {
		/** @var Simple $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		return $data;
	}
	
	protected function getFormType() {
		return SimpleEditorType::class;
	}
	
	protected function getEntity() {
		return new Simple();
	}
}