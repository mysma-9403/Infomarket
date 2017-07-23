<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\BranchCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\BranchCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class BranchCategoryAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const BRANCH_1 = 101;
	const BRANCH_2 = 102;
	const BRANCH_3 = 103;
	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];
	const BRANCH_SELECTED = [self::BRANCH_1, self::BRANCH_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var BranchCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['branches'] = self::BRANCH_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return BranchCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new BranchCategoryAssignmentFilter();
	}
}