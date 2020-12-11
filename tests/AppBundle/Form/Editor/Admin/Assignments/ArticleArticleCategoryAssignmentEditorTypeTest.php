<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment;
use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Form\Editor\Admin\Assignments\ArticleArticleCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class ArticleArticleCategoryAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const ARTICLE_ID = 100;

	const ARTICLE_NAME = 'Test article';

	const ARTICLE_CHOICES = ['Test article' => self::ARTICLE_ID];

	const ARTICLE_CATEGORY_ID = 100;

	const ARTICLE_CATEGORY_NAME = 'Test articleCategory';

	const ARTICLE_CATEGORY_CHOICES = ['Test articleCategory' => self::ARTICLE_CATEGORY_ID];

	private $articleTransformer;

	private $articleCategoryTransformer;

	protected function setUp() {
		$this->articleTransformer = $this->getEntityTransformerMock($this->getArticle(), self::ARTICLE_ID);
		$this->articleCategoryTransformer = $this->getEntityTransformerMock($this->getArticleCategory(), 
				self::ARTICLE_CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new ArticleArticleCategoryAssignmentEditorType($this->articleTransformer, 
				$this->articleCategoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var ArticleArticleCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::ARTICLE_ID, $entity->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $entity->getArticle()->getName());
		
		$this->assertSame(self::ARTICLE_CATEGORY_ID, $entity->getArticleCategory()->getId());
		$this->assertSame(self::ARTICLE_CATEGORY_NAME, $entity->getArticleCategory()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['article'] = self::ARTICLE_ID;
		$data['articleCategory'] = self::ARTICLE_CATEGORY_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('article')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('articleCategory')] = self::ARTICLE_CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return ArticleArticleCategoryAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new ArticleArticleCategoryAssignment();
	}

	private function getArticle() {
		$mock = new Article();
		$mock->setId(self::ARTICLE_ID);
		$mock->setName(self::ARTICLE_NAME);
		
		return $mock;
	}

	private function getArticleCategory() {
		$mock = new ArticleCategory();
		$mock->setId(self::ARTICLE_CATEGORY_ID);
		$mock->setName(self::ARTICLE_CATEGORY_NAME);
		
		return $mock;
	}
}