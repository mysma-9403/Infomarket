<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleArticleCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\ArticleArticleCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class ArticleArticleCategoryAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const ARTICLE_1 = 101;
	const ARTICLE_2 = 102;
	const ARTICLE_3 = 103;
	const ARTICLE_CHOICES = [self::ARTICLE_1, self::ARTICLE_2, self::ARTICLE_3];
	const ARTICLE_SELECTED = [self::ARTICLE_1, self::ARTICLE_3];
	
	const ARTICLE_CATEGORY_1 = 201;
	const ARTICLE_CATEGORY_2 = 202;
	const ARTICLE_CATEGORY_3 = 203;
	const ARTICLE_CATEGORY_CHOICES = [self::ARTICLE_CATEGORY_1, self::ARTICLE_CATEGORY_2, self::ARTICLE_CATEGORY_3];
	const ARTICLE_CATEGORY_SELECTED = [self::ARTICLE_CATEGORY_2, self::ARTICLE_CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleArticleCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ARTICLE_SELECTED, $entity->getArticles());
		$this->assertArray(self::ARTICLE_CATEGORY_SELECTED, $entity->getArticleCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['articles'] = self::ARTICLE_SELECTED;
		$data['articleCategories'] = self::ARTICLE_CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('articles')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('articleCategories')] = self::ARTICLE_CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleArticleCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new ArticleArticleCategoryAssignmentFilter();
	}
}