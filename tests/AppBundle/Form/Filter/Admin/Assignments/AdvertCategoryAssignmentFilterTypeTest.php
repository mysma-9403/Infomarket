<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\AdvertCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\AdvertCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class AdvertCategoryAssignmentFilterTypeTest extends BaseFilterTypeTest {
		
	const ADVERT_1 = 101;
	const ADVERT_2 = 102;
	const ADVERT_3 = 103;
	const ADVERT_CHOICES = [self::ADVERT_1, self::ADVERT_2, self::ADVERT_3];
	const ADVERT_SELECTED = [self::ADVERT_1, self::ADVERT_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var AdvertCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ADVERT_SELECTED, $entity->getAdverts());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['adverts'] = self::ADVERT_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('adverts')] = self::ADVERT_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return AdvertCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new AdvertCategoryAssignmentFilter();
	}
}