<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\UserCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\UserCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class UserCategoryAssignmentSimpleFilterTypeTest extends SimpleFilterTypeTest {

	const USER_1 = 101;

	const USER_2 = 102;

	const USER_3 = 103;

	const USER_CHOICES = [self::USER_1, self::USER_2, self::USER_3];

	const USER_SELECTED = [self::USER_1, self::USER_3];

	const CATEGORY_1 = 201;

	const CATEGORY_2 = 202;

	const CATEGORY_3 = 203;

	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];

	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];

	protected function assertEntity($entity) {
		/** @var UserCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::USER_SELECTED, $entity->getUsers());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['users'] = self::USER_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('users')] = self::USER_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return UserCategoryAssignmentFilterType::class;
	}

	protected function getEntity() {
		return new UserCategoryAssignmentFilter();
	}
}