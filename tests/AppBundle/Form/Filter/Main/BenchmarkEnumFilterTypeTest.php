<?php

namespace Tests\AppBundle\Form\Filter\Main;

use AppBundle\Filter\Admin\Main\BenchmarkEnumFilter;
use AppBundle\Form\Filter\Admin\Main\BenchmarkEnumFilterType;
use Tests\AppBundle\Form\Filter\Base\BaseEntityFilterTypeTest;

class BenchmarkEnumFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NAME = '*name*';
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkEnumFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		return $data;
	}
	
	protected function getFormType() {
		return BenchmarkEnumFilterType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkEnumFilter();
	}
}