<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Form\Editor\Admin\Assignments\ArticleBrandAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class ArticleBrandAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	const ARTICLE_CHOICES = ['Test article' => self::ARTICLE_ID];
	
	const BRAND_ID = 100;
	const BRAND_NAME = 'Test brand';
	const BRAND_CHOICES = ['Test brand' => self::BRAND_ID];
	
	
	
	private $articleTransformer;
	
	private $brandTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getEntityTransformerMock($this->getArticle(), self::ARTICLE_ID);
		$this->brandTransformer = $this->getEntityTransformerMock($this->getBrand(), self::BRAND_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleBrandAssignmentEditorType($this->articleTransformer, $this->brandTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var ArticleBrandAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::ARTICLE_ID, $entity->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $entity->getArticle()->getName());
		
		$this->assertSame(self::BRAND_ID, $entity->getBrand()->getId());
		$this->assertSame(self::BRAND_NAME, $entity->getBrand()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['article'] = self::ARTICLE_ID;
		$data['brand'] = self::BRAND_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('article')] = self::ARTICLE_CHOICES;
		$options[self::getChoicesName('brand')] = self::BRAND_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return ArticleBrandAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new ArticleBrandAssignment();
	}
	
	
	
	private function getArticle() {
		$mock = new Article();
		$mock->setId(self::ARTICLE_ID);
		$mock->setName(self::ARTICLE_NAME);
		
		return $mock;
	}
	
	private function getBrand() {
		$mock = new Brand();
		$mock->setId(self::BRAND_ID);
		$mock->setName(self::BRAND_NAME);
	
		return $mock;
	}
}