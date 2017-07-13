<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Assignments\NewsletterBlockMagazineAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class NewsletterBlockMagazineAssignmentEditorTypeTest extends TypeTestCase {
		
	const NEWSLETTER_BLOCK_ID = 100;
	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';
	
	const MAGAZINE_ID = 100;
	const MAGAZINE_NAME = 'Test magazine';
	
	const ALTERNATIVE_NAME = 'Alternative name';
	
	const FORM_DATA = [
			'newsletterBlock' => self::NEWSLETTER_BLOCK_ID,
			'magazine' => self::MAGAZINE_ID,
			'alternativeName' => self::ALTERNATIVE_NAME
	];
	
	const FORM_NEWSLETTER_BLOCK_LIST = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];
	const FORM_MAGAZINE_LIST = ['Test magazine' => self::MAGAZINE_ID];
	
	const FORM_OPTIONS = [
			'newsletterBlock' => self::FORM_NEWSLETTER_BLOCK_LIST,
			'magazine' => self::FORM_MAGAZINE_LIST
	];
	
	
	
	private $newsletterBlockTransformer;
	
	private $magazineTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getNewsletterBlockTransformerMock();
		$this->magazineTransformer = $this->getMagazineTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockMagazineAssignmentEditorType($this->newsletterBlockTransformer, $this->magazineTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(NewsletterBlockMagazineAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new NewsletterBlockMagazineAssignment();
		$form = $this->factory->create(NewsletterBlockMagazineAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $assignment->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $assignment->getNewsletterBlock()->getName());
		$this->assertSame(self::MAGAZINE_ID, $assignment->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $assignment->getMagazine()->getName());
		$this->assertSame(self::ALTERNATIVE_NAME, $assignment->getAlternativeName());
	}
	
	
	
	private function getNewsletterBlockTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterBlock());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	private function getMagazineTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMagazine());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	
	private function getNewsletterBlock() {
		$mock = new NewsletterBlock();
		$mock->setId(self::NEWSLETTER_BLOCK_ID);
		$mock->setName(self::NEWSLETTER_BLOCK_NAME);
		
		return $mock;
	}
	
	private function getMagazine() {
		$mock = new Magazine();
		$mock->setId(self::MAGAZINE_ID);
		$mock->setName(self::MAGAZINE_NAME);
	
		return $mock;
	}
}