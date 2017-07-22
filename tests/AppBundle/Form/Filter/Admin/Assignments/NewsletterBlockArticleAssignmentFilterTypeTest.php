<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\NewsletterBlockArticleAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockArticleAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class NewsletterBlockArticleAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const NEWSLETTER_BLOCK_1 = 101;
	const NEWSLETTER_BLOCK_2 = 102;
	const NEWSLETTER_BLOCK_3 = 103;
	const NEWSLETTER_BLOCK_CHOICES = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_2, self::NEWSLETTER_BLOCK_3];
	const NEWSLETTER_BLOCK_SELECTED = [self::NEWSLETTER_BLOCK_1, self::NEWSLETTER_BLOCK_3];
	
	const ARTICLE_1 = 201;
	const ARTICLE_2 = 202;
	const ARTICLE_3 = 203;
	const ARTICLE_CHOICES = [self::ARTICLE_1, self::ARTICLE_2, self::ARTICLE_3];
	const ARTICLE_SELECTED = [self::ARTICLE_2, self::ARTICLE_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockArticleAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::NEWSLETTER_BLOCK_SELECTED, $entity->getNewsletterBlocks());
		$this->assertArray(self::ARTICLE_SELECTED, $entity->getArticles());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterBlocks'] = self::NEWSLETTER_BLOCK_SELECTED;
		$data['articles'] = self::ARTICLE_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterBlocks')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('articles')] = self::ARTICLE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockArticleAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockArticleAssignmentFilter();
	}
}