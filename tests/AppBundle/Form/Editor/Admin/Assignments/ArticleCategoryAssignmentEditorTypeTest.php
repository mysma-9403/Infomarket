<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Admin\Assignments\ArticleCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class ArticleCategoryAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	const ARTICLE_CHOICES = ['Test article' => self::ARTICLE_ID];
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];
	
	
	
	private $articleTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getEntityTransformerMock($this->getArticle(), self::ARTICLE_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleCategoryAssignmentEditorType($this->articleTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::ARTICLE_ID, $entity->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $entity->getArticle()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['article'] = self::ARTICLE_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('article')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleCategoryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new ArticleCategoryAssignment();
	}
	
	
	
	private function getArticle() {
		$mock = new Article();
		$mock->setId(self::ARTICLE_ID);
		$mock->setName(self::ARTICLE_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}