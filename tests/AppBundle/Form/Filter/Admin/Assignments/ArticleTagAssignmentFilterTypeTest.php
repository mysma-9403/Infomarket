<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\ArticleTagAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class ArticleTagAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const ARTICLE_1 = 101;
	const ARTICLE_2 = 102;
	const ARTICLE_3 = 103;
	const ARTICLE_CHOICES = [self::ARTICLE_1, self::ARTICLE_2, self::ARTICLE_3];
	const ARTICLE_SELECTED = [self::ARTICLE_1, self::ARTICLE_3];
	
	const TAG_1 = 201;
	const TAG_2 = 202;
	const TAG_3 = 203;
	const TAG_CHOICES = [self::TAG_1, self::TAG_2, self::TAG_3];
	const TAG_SELECTED = [self::TAG_2, self::TAG_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleTagAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ARTICLE_SELECTED, $entity->getArticles());
		$this->assertArray(self::TAG_SELECTED, $entity->getTags());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['articles'] = self::ARTICLE_SELECTED;
		$data['tags'] = self::TAG_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('articles')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('tags')] = self::TAG_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleTagAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new ArticleTagAssignmentFilter();
	}
}