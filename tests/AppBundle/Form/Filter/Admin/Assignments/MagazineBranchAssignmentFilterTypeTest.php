<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MagazineBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\MagazineBranchAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class MagazineBranchAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const MAGAZINE_1 = 101;
	const MAGAZINE_2 = 102;
	const MAGAZINE_3 = 103;
	const MAGAZINE_CHOICES = [self::MAGAZINE_1, self::MAGAZINE_2, self::MAGAZINE_3];
	const MAGAZINE_SELECTED = [self::MAGAZINE_1, self::MAGAZINE_3];
	
	const BRANCH_1 = 201;
	const BRANCH_2 = 202;
	const BRANCH_3 = 203;
	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];
	const BRANCH_SELECTED = [self::BRANCH_2, self::BRANCH_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var MagazineBranchAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::MAGAZINE_SELECTED, $entity->getMagazines());
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['magazines'] = self::MAGAZINE_SELECTED;
		$data['branches'] = self::BRANCH_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('magazines')] = self::MAGAZINE_CHOICES;
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MagazineBranchAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new MagazineBranchAssignmentFilter();
	}
}