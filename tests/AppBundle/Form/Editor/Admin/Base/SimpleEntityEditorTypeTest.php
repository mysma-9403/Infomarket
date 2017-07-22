<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\SimpleEntity;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;

class SimpleEntityEditorTypeTest extends BaseEntityEditorTypeTest {
	
	const NAME = 'Test name';
	const INFOMARKET = true;
	const INFOPRODUKT = true;
	
	protected function assertEntity($entity) {
		/** @var SimpleEntity $entity */
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
		return SimpleEntityEditorType::class;
	}
	
	protected function getEntity() {
		return new SimpleEntity();
	}
}