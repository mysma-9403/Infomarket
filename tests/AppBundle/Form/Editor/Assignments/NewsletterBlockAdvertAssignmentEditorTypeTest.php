<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockAdvertAssignment;
use AppBundle\Entity\Advert;
use AppBundle\Form\Editor\Assignments\NewsletterBlockAdvertAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class NewsletterBlockAdvertAssignmentEditorTypeTest extends TypeTestCase {
		
	const NEWSLETTER_BLOCK_ID = 100;
	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';
	
	const ADVERT_ID = 100;
	const ADVERT_NAME = 'Test advert';
	
	const FORM_DATA = [
			'newsletterBlock' => self::NEWSLETTER_BLOCK_ID,
			'advert' => self::ADVERT_ID
	];
	
	const FORM_NEWSLETTER_BLOCK_LIST = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];
	const FORM_ADVERT_LIST = ['Test advert' => self::ADVERT_ID];
	
	const FORM_OPTIONS = [
			'newsletterBlock' => self::FORM_NEWSLETTER_BLOCK_LIST,
			'advert' => self::FORM_ADVERT_LIST
	];
	
	
	
	private $newsletterBlockTransformer;
	
	private $advertTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getNewsletterBlockTransformerMock();
		$this->advertTransformer = $this->getAdvertTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockAdvertAssignmentEditorType($this->newsletterBlockTransformer, $this->advertTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(NewsletterBlockAdvertAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new NewsletterBlockAdvertAssignment();
		$form = $this->factory->create(NewsletterBlockAdvertAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $assignment->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $assignment->getNewsletterBlock()->getName());
		$this->assertSame(self::ADVERT_ID, $assignment->getAdvert()->getId());
		$this->assertSame(self::ADVERT_NAME, $assignment->getAdvert()->getName());
	}
	
	
	
	private function getNewsletterBlockTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterBlock());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	private function getAdvertTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getAdvert());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_ID);
	
		return $mock;
	}
	
	
	private function getNewsletterBlock() {
		$mock = new NewsletterBlock();
		$mock->setId(self::NEWSLETTER_BLOCK_ID);
		$mock->setName(self::NEWSLETTER_BLOCK_NAME);
		
		return $mock;
	}
	
	private function getAdvert() {
		$mock = new Advert();
		$mock->setId(self::ADVERT_ID);
		$mock->setName(self::ADVERT_NAME);
	
		return $mock;
	}
}