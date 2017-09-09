<?php

namespace Tests\AppBundle\Form\Filter\Infoprodukt;

use AppBundle\Filter\Infoprodukt\Main\ArticleFilter;
use AppBundle\Form\Filter\Infoprodukt\ArticleFilterType;
use Tests\AppBundle\Form\Base\FilterTypeTest;

class ArticleFilterTypeTest extends FilterTypeTest {

	const ARTICLE_CATEGORY_1 = 101;

	const ARTICLE_CATEGORY_2 = 102;

	const ARTICLE_CATEGORY_3 = 103;

	const ARTICLE_CATEGORY_CHOICES = [self::ARTICLE_CATEGORY_1, self::ARTICLE_CATEGORY_2, 
			self::ARTICLE_CATEGORY_3];

	const ARTICLE_CATEGORY_SELECTED = [self::ARTICLE_CATEGORY_1, self::ARTICLE_CATEGORY_3];

	protected function assertEntity($entity) {
		/** @var ArticleFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::ARTICLE_CATEGORY_SELECTED, $entity->getArticleCategories());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['articleCategories'] = self::ARTICLE_CATEGORY_SELECTED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('articleCategories')] = self::ARTICLE_CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return ArticleFilterType::class;
	}

	protected function getEntity() {
		return new ArticleFilter();
	}
}