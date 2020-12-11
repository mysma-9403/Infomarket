<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\MagazineFilter;
use AppBundle\Form\Filter\Admin\Main\MagazineFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\SimpleFilterTypeTest;

class MagazineFilterTypeTest extends SimpleFilterTypeTest {

	const NAME = '*name*';

	const INFOMARKET_FALSE = 0;

	const INFOMARKET_TRUE = 1;

	const INFOMARKET_ALL = 2;

	const INFOMARKET_CHOICES = [self::INFOMARKET_FALSE, self::INFOMARKET_TRUE, self::INFOMARKET_ALL];

	const INFOMARKET_SELECTED = self::INFOMARKET_TRUE;

	const INFOPRODUKT_FALSE = 0;

	const INFOPRODUKT_TRUE = 1;

	const INFOPRODUKT_ALL = 2;

	const INFOPRODUKT_CHOICES = [self::INFOPRODUKT_FALSE, self::INFOPRODUKT_TRUE, self::INFOPRODUKT_ALL];

	const INFOPRODUKT_SELECTED = self::INFOPRODUKT_TRUE;

	const FEATURED_FALSE = 0;

	const FEATURED_TRUE = 1;

	const FEATURED_ALL = 2;

	const FEATURED_CHOICES = [self::FEATURED_FALSE, self::FEATURED_TRUE, self::FEATURED_ALL];

	const FEATURED_SELECTED = self::FEATURED_TRUE;

	const BRANCH_1 = 101;

	const BRANCH_2 = 102;

	const BRANCH_3 = 103;

	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];

	const BRANCH_SELECTED = [self::BRANCH_2, self::BRANCH_3];

	const CATEGORY_1 = 201;

	const CATEGORY_2 = 202;

	const CATEGORY_3 = 203;

	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];

	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];

	const MAGAZINE_1 = 101;

	const MAGAZINE_2 = 102;

	const MAGAZINE_3 = 103;

	const MAGAZINE_CHOICES = [self::MAGAZINE_1, self::MAGAZINE_2, self::MAGAZINE_3];

	const MAGAZINE_SELECTED = [self::MAGAZINE_2, self::MAGAZINE_3];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var MagazineFilter $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		$this->assertSame(self::FEATURED_SELECTED, $entity->getFeatured());
		
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
		$this->assertArray(self::MAGAZINE_SELECTED, $entity->getParents());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		$data['featured'] = self::FEATURED_SELECTED;
		
		$data['branches'] = self::BRANCH_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		$data['parents'] = self::MAGAZINE_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		$options[self::getChoicesName('featured')] = self::FEATURED_CHOICES;
		
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
		$options[self::getChoicesName('parents')] = self::MAGAZINE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return MagazineFilterType::class;
	}

	protected function getEntity() {
		return new MagazineFilter();
	}
}