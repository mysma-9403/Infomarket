<?php

namespace Tests\AppBundle\Form\Filter\Benchmark;

use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Form\Filter\Benchmark\BenchmarkMessageFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class BenchmarkMessageFilterTypeTest extends BaseFilterTypeTest {
	
	const NAME = '*name*';
	
	const READ_FALSE = 0;
	const READ_TRUE = 1;
	const READ_ALL = 2;
	const READ_CHOICES = [self::READ_FALSE, self::READ_TRUE, self::READ_ALL];
	const READ_SELECTED = self::READ_TRUE;
	
	const PRODUCT_1 = 101;
	const PRODUCT_2 = 102;
	const PRODUCT_3 = 103;
	const PRODUCT_CHOICES = [self::PRODUCT_1, self::PRODUCT_2, self::PRODUCT_3];
	const PRODUCT_SELECTED = [self::PRODUCT_1, self::PRODUCT_3];
	
	const STATE_1 = 11;
	const STATE_2 = 12;
	const STATE_3 = 13;
	const STATE_CHOICES = [self::STATE_1, self::STATE_2, self::STATE_3];
	const STATE_SELECTED = [self::STATE_2, self::STATE_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var BenchmarkMessageFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::READ_SELECTED, $entity->getReadByAuthor());
		
		$this->assertArray(self::PRODUCT_SELECTED, $entity->getProducts());
		$this->assertArray(self::STATE_SELECTED, $entity->getStates());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['readByAuthor'] = self::READ_SELECTED;
		
		$data['products'] = self::PRODUCT_SELECTED;
		$data['states'] = self::STATE_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('readByAuthor')] = self::READ_CHOICES;
		
		$options[self::getChoicesName('products')] = self::PRODUCT_CHOICES;
		$options[self::getChoicesName('states')] = self::STATE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return BenchmarkMessageFilterType::class;
	}
	
	protected function getEntity() {
		return new BenchmarkMessageFilter();
	}
}