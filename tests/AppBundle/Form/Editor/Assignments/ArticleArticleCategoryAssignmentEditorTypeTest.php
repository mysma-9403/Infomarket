<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\Editor\Assignments\ArticleArticleCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ArticleArticleCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	
	const ARTICLE_CATEGORY_ID = 100;
	const ARTICLE_CATEGORY_NAME = 'Test articleCategory';
	
	const FORM_DATA = [
			'article' => self::ARTICLE_ID,
			'articleCategory' => self::ARTICLE_CATEGORY_ID
	];
	
	const FORM_ARTICLE_LIST = ['Test article' => self::ARTICLE_ID];
	const FORM_ARTICLE_CATEGORY_LIST = ['Test articleCategory' => self::ARTICLE_CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'article' => self::FORM_ARTICLE_LIST,
			'articleCategory' => self::FORM_ARTICLE_CATEGORY_LIST
	];
	
	
	
	private $articleTransformer;
	
	private $articleCategoryTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getArticleTransformerMock();
		$this->articleCategoryTransformer = $this->getArticleCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleArticleCategoryAssignmentEditorType($this->articleTransformer, $this->articleCategoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(ArticleArticleCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new ArticleArticleCategoryAssignment();
		$form = $this->factory->create(ArticleArticleCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::ARTICLE_ID, $assignment->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $assignment->getArticle()->getName());
		$this->assertSame(self::ARTICLE_CATEGORY_ID, $assignment->getArticleCategory()->getId());
		$this->assertSame(self::ARTICLE_CATEGORY_NAME, $assignment->getArticleCategory()->getName());
	}
	
	
	
	private function getArticleTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticle());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
	}
	
	private function getArticleCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticleCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
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