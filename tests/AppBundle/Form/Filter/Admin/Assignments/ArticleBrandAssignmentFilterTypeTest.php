<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleBrandAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\ArticleBrandAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class ArticleBrandAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const ARTICLE_1 = 101;
	const ARTICLE_2 = 102;
	const ARTICLE_3 = 103;
	const ARTICLE_CHOICES = [self::ARTICLE_1, self::ARTICLE_2, self::ARTICLE_3];
	const ARTICLE_SELECTED = [self::ARTICLE_1, self::ARTICLE_3];
	
	const BRAND_1 = 201;
	const BRAND_2 = 202;
	const BRAND_3 = 203;
	const BRAND_CHOICES = [self::BRAND_1, self::BRAND_2, self::BRAND_3];
	const BRAND_SELECTED = [self::BRAND_2, self::BRAND_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleBrandAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ARTICLE_SELECTED, $entity->getArticles());
		$this->assertArray(self::BRAND_SELECTED, $entity->getBrands());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['articles'] = self::ARTICLE_SELECTED;
		$data['brands'] = self::BRAND_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('articles')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('brands')] = self::BRAND_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleBrandAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new ArticleBrandAssignmentFilter();
	}
}