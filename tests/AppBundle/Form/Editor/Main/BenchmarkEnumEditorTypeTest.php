<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Editor\Main\BenchmarkEnumEditorType;

class BenchmarkEnumEditorTypeTest extends BaseEntityEditorType {
	
	const NAME = 'Test name';
	const VALUE = 15;
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkEnum $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::VALUE, $entity->getValue());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['featured'] = self::FEATURED;
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['subname'] = self::SUBNAME;
		
		return $data;
	}
	
	protected function getFormType() {
		return BenchmarkEnumEditorType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkEnum();
	}
}