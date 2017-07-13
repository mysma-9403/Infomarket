<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Assignments\NewsletterUserNewsletterGroupAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class NewsletterUserNewsletterGroupAssignmentEditorTypeTest extends TypeTestCase {
		
	const NEWSLETTER_USER_ID = 100;
	const NEWSLETTER_USER_NAME = 'Test newsletterUser';
	
	const NEWSLETTER_GROUP_ID = 100;
	const NEWSLETTER_GROUP_NAME = 'Test newsletterGroup';
	
	const FORM_DATA = [
			'newsletterUser' => self::NEWSLETTER_USER_ID,
			'newsletterGroup' => self::NEWSLETTER_GROUP_ID
	];
	
	const FORM_NEWSLETTER_USER_LIST = ['Test newsletterUser' => self::NEWSLETTER_USER_ID];
	const FORM_NEWSLETTER_GROUP_LIST = ['Test newsletterGroup' => self::NEWSLETTER_GROUP_ID];
	
	const FORM_OPTIONS = [
			'newsletterUser' => self::FORM_NEWSLETTER_USER_LIST,
			'newsletterGroup' => self::FORM_NEWSLETTER_GROUP_LIST
	];
	
	
	
	private $newsletterUserTransformer;
	
	private $newsletterGroupTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterUserTransformer = $this->getNewsletterUserTransformerMock();
		$this->newsletterGroupTransformer = $this->getNewsletterGroupTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterUserNewsletterGroupAssignmentEditorType($this->newsletterUserTransformer, $this->newsletterGroupTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(NewsletterUserNewsletterGroupAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new NewsletterUserNewsletterGroupAssignment();
		$form = $this->factory->create(NewsletterUserNewsletterGroupAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::NEWSLETTER_USER_ID, $assignment->getNewsletterUser()->getId());
		$this->assertSame(self::NEWSLETTER_USER_NAME, $assignment->getNewsletterUser()->getName());
		$this->assertSame(self::NEWSLETTER_GROUP_ID, $assignment->getNewsletterGroup()->getId());
		$this->assertSame(self::NEWSLETTER_GROUP_NAME, $assignment->getNewsletterGroup()->getName());
	}
	
	
	
	private function getNewsletterUserTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterUser());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_USER_ID);
	
		return $mock;
	}
	
	private function getNewsletterGroupTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterGroup());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_USER_ID);
	
		return $mock;
	}
	
	
	private function getNewsletterUser() {
		$mock = new NewsletterUser();
		$mock->setId(self::NEWSLETTER_USER_ID);
		$mock->setName(self::NEWSLETTER_USER_NAME);
		
		return $mock;
	}
	
	private function getNewsletterGroup() {
		$mock = new NewsletterGroup();
		$mock->setId(self::NEWSLETTER_GROUP_ID);
		$mock->setName(self::NEWSLETTER_GROUP_NAME);
	
		return $mock;
	}
}