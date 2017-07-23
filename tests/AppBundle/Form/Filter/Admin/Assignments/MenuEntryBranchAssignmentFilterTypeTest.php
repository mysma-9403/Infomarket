<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuEntryBranchAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\MenuEntryBranchAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class MenuEntryBranchAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const MENU_ENTRY_1 = 101;
	const MENU_ENTRY_2 = 102;
	const MENU_ENTRY_3 = 103;
	const MENU_ENTRY_CHOICES = [self::MENU_ENTRY_1, self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	const MENU_ENTRY_SELECTED = [self::MENU_ENTRY_1, self::MENU_ENTRY_3];
	
	const BRANCH_1 = 201;
	const BRANCH_2 = 202;
	const BRANCH_3 = 203;
	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];
	const BRANCH_SELECTED = [self::BRANCH_2, self::BRANCH_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuEntryBranchAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::MENU_ENTRY_SELECTED, $entity->getMenuEntries());
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['menuEntries'] = self::MENU_ENTRY_SELECTED;
		$data['branches'] = self::BRANCH_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('menuEntries')] = self::MENU_ENTRY_CHOICES;
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuEntryBranchAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new MenuEntryBranchAssignmentFilter();
	}
}