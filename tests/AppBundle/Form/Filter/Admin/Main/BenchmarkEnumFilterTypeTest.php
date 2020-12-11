<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\BenchmarkEnumFilter;
use AppBundle\Form\Filter\Admin\Main\BenchmarkEnumFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class BenchmarkEnumFilterTypeTest extends SimpleFilterTypeTest {

	const NAME = '*name*';

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var BenchmarkEnumFilter $entity */
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