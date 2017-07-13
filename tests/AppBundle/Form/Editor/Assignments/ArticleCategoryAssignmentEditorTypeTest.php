<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\ArticleCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ArticleCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'article' => self::ARTICLE_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_ARTICLE_LIST = ['Test article' => self::ARTICLE_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'article' => self::FORM_ARTICLE_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $articleTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getArticleTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleCategoryAssignmentEditorType($this->articleTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(ArticleCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new ArticleCategoryAssignment();
		$form = $this->factory->create(ArticleCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::ARTICLE_ID, $assignment->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $assignment->getArticle()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getArticleTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticle());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
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