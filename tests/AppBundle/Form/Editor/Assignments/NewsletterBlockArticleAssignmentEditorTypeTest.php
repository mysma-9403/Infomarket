<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Entity\Article;
use AppBundle\Form\Editor\Assignments\NewsletterBlockArticleAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class NewsletterBlockArticleAssignmentEditorTypeTest extends TypeTestCase {
		
	const NEWSLETTER_BLOCK_ID = 100;
	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';
	
	const ARTICLE_ID = 100;
	const ARTICLE_NAME = 'Test article';
	
	const ALTERNATIVE_NAME = 'Alternative name';
	const ALTERNATIVE_SUBNAME = 'Alternative subname';
	const ALTERNATIVE_BRANDS = 'Alternative brands';
	
	const FORM_DATA = [
			'newsletterBlock' => self::NEWSLETTER_BLOCK_ID,
			'article' => self::ARTICLE_ID,
			'alternativeName' => self::ALTERNATIVE_NAME,
			'alternativeSubname' => self::ALTERNATIVE_SUBNAME,
			'alternativeBrands' => self::ALTERNATIVE_BRANDS
	];
	
	const FORM_NEWSLETTER_BLOCK_LIST = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];
	const FORM_ARTICLE_LIST = ['Test article' => self::ARTICLE_ID];
	
	const FORM_OPTIONS = [
			'newsletterBlock' => self::FORM_NEWSLETTER_BLOCK_LIST,
			'article' => self::FORM_ARTICLE_LIST
	];
	
	
	
	private $newsletterBlockTransformer;
	
	private $articleTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getNewsletterBlockTransformerMock();
		$this->articleTransformer = $this->getArticleTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockArticleAssignmentEditorType($this->newsletterBlockTransformer, $this->articleTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(NewsletterBlockArticleAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new NewsletterBlockArticleAssignment();
		$form = $this->factory->create(NewsletterBlockArticleAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $assignment->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $assignment->getNewsletterBlock()->getName());
		$this->assertSame(self::ARTICLE_ID, $assignment->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $assignment->getArticle()->getName());
		$this->assertSame(self::ALTERNATIVE_NAME, $assignment->getAlternativeName());
		$this->assertSame(self::ALTERNATIVE_SUBNAME, $assignment->getAlternativeSubname());
		$this->assertSame(self::ALTERNATIVE_BRANDS, $assignment->getAlternativeBrands());
	}
	
	
	
	private function getNewsletterBlockTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterBlock());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	private function getArticleTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getArticle());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	
	private function getNewsletterBlock() {
		$mock = new NewsletterBlock();
		$mock->setId(self::NEWSLETTER_BLOCK_ID);
		$mock->setName(self::NEWSLETTER_BLOCK_NAME);
		
		return $mock;
	}
	
	private function getArticle() {
		$mock = new Article();
		$mock->setId(self::ARTICLE_ID);
		$mock->setName(self::ARTICLE_NAME);
	
		return $mock;
	}
}