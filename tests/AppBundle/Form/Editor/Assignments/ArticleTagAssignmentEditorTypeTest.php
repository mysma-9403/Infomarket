<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Assignments\ArticleTagAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class ArticleTagAssignmentEditorTypeTest extends TypeTestCase {
		
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	
	const TAG_ID = 100;
	const TAG_NAME = 'Test tag';
	
	const FORM_DATA = [
			'article' => self::ARTICLE_ID,
			'tag' => self::TAG_ID
	];
	
	const FORM_ARTICLE_LIST = ['Test article' => self::ARTICLE_ID];
	const FORM_TAG_LIST = ['Test tag' => self::TAG_ID];
	
	const FORM_OPTIONS = [
			'article' => self::FORM_ARTICLE_LIST,
			'tag' => self::FORM_TAG_LIST
	];
	
	
	
	private $articleTransformer;
	
	private $tagTransformer;
	
	
	
	protected function setUp() {
		$this->articleTransformer = $this->getArticleTransformerMock();
		$this->tagTransformer = $this->getTagTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ArticleTagAssignmentEditorType($this->articleTransformer, $this->tagTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(ArticleTagAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
			
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new ArticleTagAssignment();
		$form = $this->factory->create(ArticleTagAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::ARTICLE_ID, $assignment->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $assignment->getArticle()->getName());
		$this->assertSame(self::TAG_ID, $assignment->getTag()->getId());
		$this->assertSame(self::TAG_NAME, $assignment->getTag()->getName());
	}
	
	
	
	private function getArticleTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticle());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
	}
	
	private function getTagTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getTag());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ARTICLE_ID);
	
		return $mock;
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