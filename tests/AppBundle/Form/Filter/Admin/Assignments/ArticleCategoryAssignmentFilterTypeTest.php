<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\ArticleCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\ArticleCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class ArticleCategoryAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const ARTICLE_1 = 101;
	const ARTICLE_2 = 102;
	const ARTICLE_3 = 103;
	const ARTICLE_CHOICES = [self::ARTICLE_1, self::ARTICLE_2, self::ARTICLE_3];
	const ARTICLE_SELECTED = [self::ARTICLE_1, self::ARTICLE_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ARTICLE_SELECTED, $entity->getArticles());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['articles'] = self::ARTICLE_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('articles')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new ArticleCategoryAssignmentFilter();
	}
}