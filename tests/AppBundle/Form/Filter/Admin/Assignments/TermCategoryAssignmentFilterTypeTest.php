<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\TermCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\TermCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class TermCategoryAssignmentFilterTypeTest extends BaseFilterTypeTest {
		
	const TERM_1 = 101;
	const TERM_2 = 102;
	const TERM_3 = 103;
	const TERM_CHOICES = [self::TERM_1, self::TERM_2, self::TERM_3];
	const TERM_SELECTED = [self::TERM_1, self::TERM_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var TermCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::TERM_SELECTED, $entity->getTerms());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['terms'] = self::TERM_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('terms')] = self::TERM_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return TermCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new TermCategoryAssignmentFilter();
	}
}