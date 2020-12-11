<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\BenchmarkEnum;
use AppBundle\Form\Editor\Admin\Main\BenchmarkEnumEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class BenchmarkEnumEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const VALUE = 15;

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var BenchmarkEnum $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::VALUE, $entity->getValue());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['value'] = self::VALUE;
		
		return $data;
	}

	protected function getFormType() {
		return BenchmarkEnumEditorType::class;
	}

	protected function getEntity() {
		return new BenchmarkEnum();
	}
}