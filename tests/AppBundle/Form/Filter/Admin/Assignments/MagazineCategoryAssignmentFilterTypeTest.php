<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\MagazineCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\MagazineCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class MagazineCategoryAssignmentSimpleFilterTypeTest extends SimpleFilterTypeTest {

	const MAGAZINE_1 = 101;

	const MAGAZINE_2 = 102;

	const MAGAZINE_3 = 103;

	const MAGAZINE_CHOICES = [self::MAGAZINE_1, self::MAGAZINE_2, self::MAGAZINE_3];

	const MAGAZINE_SELECTED = [self::MAGAZINE_1, self::MAGAZINE_3];

	const CATEGORY_1 = 201;

	const CATEGORY_2 = 202;

	const CATEGORY_3 = 203;

	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];

	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];

	protected function assertEntity($entity) {
		/** @var MagazineCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::MAGAZINE_SELECTED, $entity->getMagazines());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['magazines'] = self::MAGAZINE_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('magazines')] = self::MAGAZINE_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return MagazineCategoryAssignmentFilterType::class;
	}

	protected function getEntity() {
		return new MagazineCategoryAssignmentFilter();
	}
}