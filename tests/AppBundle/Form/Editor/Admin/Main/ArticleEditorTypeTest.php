<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Article;
use AppBundle\Form\Editor\Admin\Main\ArticleEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;
use AppBundle\Entity\Main\User;

class ArticleEditorTypeTest extends ImageEditorTypeTest {
	
	const SUBNAME = 'Test subname';
	
	const ARCHIVED = true;
	const FEATURED = true;
	
	const PAGE = 2;
	const ORDER_NUMBER = 76;
	
	const INTRO = 'Test intro';
	const CONTENT = 'Test content';
	
	const DATE = '19/10/2015 11:09';
	const END_DATE = '19/10/2016 11:11';
	
	const LAYOUT = 3;
	const LAYOUT_CHOICES = ['Test layout' => self::LAYOUT];
	
	const IMAGE_SIZE = 1;
	const IMAGE_SIZE_CHOICES = ['Test image size' => self::IMAGE_SIZE];
	
	const PARENT_ID = 1071;
	const PARENT_NAME = 'Test name';
	const PARENT_CHOICES = ['Parent' => self::PARENT_ID];
	
	const AUTHOR_ID = 5;
	const AUTHOR_USERNAME = 'Test username';
	const AUTHOR_CHOICES = ['AUTHOR' => self::AUTHOR_ID];
	
	
	
	private $parentTransformer;
	
	private $authorTransformer;
	
	
	
	protected function setUp() {
		$this->parentTransformer = $this->getEntityTransformerMock($this->getParent(), self::PARENT_ID);
		$this->authorTransformer = $this->getEntityTransformerMock($this->getAuthor(), self::AUTHOR_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleEditorType($this->parentTransformer, $this->authorTransformer);
		
		return array(new PreloadedExtension(array($this->getCKEditor(), $type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var Article $entity */
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::ARCHIVED, $entity->getArchived());
		$this->assertSame(self::FEATURED, $entity->getFeatured());
		
		$this->assertSame(self::PAGE, $entity->getPage());
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		
		$this->assertSame(self::INTRO, $entity->getIntro());
		$this->assertSame(self::CONTENT, $entity->getContent());
		
		$this->assertDateTime(self::DATE, $entity->getDate());
		$this->assertDateTime(self::END_DATE, $entity->getEndDate());
		
		$this->assertSame(self::LAYOUT, $entity->getLayout());
		$this->assertSame(self::IMAGE_SIZE, $entity->getImageSize());
		
		$this->assertSame(self::PARENT_ID, $entity->getParent()->getId());
		$this->assertSame(self::PARENT_NAME, $entity->getParent()->getName());
		
		$this->assertSame(self::AUTHOR_ID, $entity->getAuthor()->getId());
		$this->assertSame(self::AUTHOR_USERNAME, $entity->getAuthor()->getUsername());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['subname'] = self::SUBNAME;
		
		$data['archived'] = self::ARCHIVED;
		$data['featured'] = self::FEATURED;
		
		$data['page'] = self::PAGE;
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		$data['intro'] = self::INTRO;
		$data['content'] = self::CONTENT;
		
		$data['date'] = self::DATE;
		$data['endDate'] = self::END_DATE;
		
		$data['layout'] = self::LAYOUT;
		$data['imageSize'] = self::IMAGE_SIZE;
		
		$data['parent'] = self::PARENT_ID;
		$data['author'] = self::AUTHOR_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('parent')] = self::PARENT_CHOICES;
		$options[self::getChoicesName('author')] = self::AUTHOR_CHOICES;
		
		$options[self::getChoicesName('layout')] = self::LAYOUT_CHOICES;
		$options[self::getChoicesName('imageSize')] = self::IMAGE_SIZE_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return ArticleEditorType::class;
	}
	
	protected function getEntity() {
		return new Article();
	}
	
	
	
	private function getParent() {
		$mock = new Article();
		$mock->setId(self::PARENT_ID);
		$mock->setName(self::PARENT_NAME);
	
		return $mock;
	}
	
	private function getAuthor() {
		$mock = new User();
		$mock->setId(self::AUTHOR_ID);
		$mock->setUsername(self::AUTHOR_USERNAME);
	
		return $mock;
	}
}