<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Form\Editor\Assignments\ArticleBrandAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ArticleBrandAssignmentEditorTypeTest extends TypeTestCase {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	
	const BRAND_ID = 100;
	const BRAND_NAME = 'Test brand';
	
	const FORM_DATA = [
			'article' => self::ARTICLE_ID,
			'brand' => self::BRAND_ID
	];
	
	const FORM_ARTICLE_LIST = ['Test article' => self::ARTICLE_ID];
	const FORM_BRAND_LIST = ['Test brand' => self::BRAND_ID];
	
	const FORM_OPTIONS = [
			'article' => self::FORM_ARTICLE_LIST,
			'brand' => self::FORM_BRAND_LIST
	];
	
	
	
	private $articleTransformer;
	
	private $brandTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getArticleTransformerMock();
		$this->brandTransformer = $this->getBrandTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleBrandAssignmentEditorType($this->articleTransformer, $this->brandTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(ArticleBrandAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new ArticleBrandAssignment();
		$form = $this->factory->create(ArticleBrandAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::ARTICLE_ID, $assignment->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $assignment->getArticle()->getName());
		$this->assertSame(self::BRAND_ID, $assignment->getBrand()->getId());
		$this->assertSame(self::BRAND_NAME, $assignment->getBrand()->getName());
	}
	
	
	
	private function getArticleTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticle());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
	}
	
	private function getBrandTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getBrand());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
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