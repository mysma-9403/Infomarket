<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Admin\Assignments\ArticleTagAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class ArticleTagAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	const ARTICLE_CHOICES = ['Test article' => self::ARTICLE_ID];
	
	const TAG_ID = 100;
	const TAG_NAME = 'Test tag';
	const TAG_CHOICES = ['Test tag' => self::TAG_ID];
	
	
	
	private $articleTransformer;
	
	private $tagTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getEntityTransformerMock($this->getArticle(), self::ARTICLE_ID);
		$this->tagTransformer = $this->getEntityTransformerMock($this->getTag(), self::TAG_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleTagAssignmentEditorType($this->articleTransformer, $this->tagTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleTagAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::ARTICLE_ID, $entity->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $entity->getArticle()->getName());
		
		$this->assertSame(self::TAG_ID, $entity->getTag()->getId());
		$this->assertSame(self::TAG_NAME, $entity->getTag()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['article'] = self::ARTICLE_ID;
		$data['tag'] = self::TAG_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('article')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('tag')] = self::TAG_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleTagAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new ArticleTagAssignment();
	}
	
	
	
	private function getArticle() {
		$mock = new Article();
		$mock->setId(self::ARTICLE_ID);
		$mock->setName(self::ARTICLE_NAME);
		
		return $mock;
	}
	
	private function getTag() {
		$mock = new Tag();
		$mock->setId(self::TAG_ID);
		$mock->setName(self::TAG_NAME);
	
		return $mock;
	}
}