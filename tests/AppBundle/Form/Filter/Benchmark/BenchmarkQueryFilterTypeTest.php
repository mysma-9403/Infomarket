<?php

namespace Tests\AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Form\Filter\Benchmark\BenchmarkQueryFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class BenchmarkQueryFilterTypeTest extends BaseFilterTypeTest {
	
	const NAME = '*name*';
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkQueryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		return $data;
	}
	
	protected function getFormType() {
		return BenchmarkQueryFilterType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkQueryFilter();
	}
}