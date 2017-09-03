<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterUser;
use AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\Assignments\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterUserNewsletterGroupAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEditorTypeTest;

class NewsletterUserNewsletterGroupAssignmentEditorTypeTest extends BaseEditorTypeTest {
		
	const NEWSLETTER_USER_ID = 100;
	const NEWSLETTER_USER_NAME = 'Test newsletterUser';
	const NEWSLETTER_USER_CHOICES = ['Test newsletterUser' => self::NEWSLETTER_USER_ID];
	
	const NEWSLETTER_GROUP_ID = 100;
	const NEWSLETTER_GROUP_NAME = 'Test newsletterGroup';
	const NEWSLETTER_GROUP_CHOICES = ['Test newsletterGroup' => self::NEWSLETTER_GROUP_ID];
	
	
	
	private $newsletterUserTransformer;
	
	private $newsletterGroupTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterUserTransformer = $this->getEntityTransformerMock($this->getNewsletterUser(), self::NEWSLETTER_USER_ID);
		$this->newsletterGroupTransformer = $this->getEntityTransformerMock($this->getNewsletterGroup(), self::NEWSLETTER_GROUP_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterUserNewsletterGroupAssignmentEditorType($this->newsletterUserTransformer, $this->newsletterGroupTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterUserNewsletterGroupAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NEWSLETTER_USER_ID, $entity->getNewsletterUser()->getId());
		$this->assertSame(self::NEWSLETTER_USER_NAME, $entity->getNewsletterUser()->getName());
		
		$this->assertSame(self::NEWSLETTER_GROUP_ID, $entity->getNewsletterGroup()->getId());
		$this->assertSame(self::NEWSLETTER_GROUP_NAME, $entity->getNewsletterGroup()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterUser'] = self::NEWSLETTER_USER_ID;
		$data['newsletterGroup'] = self::NEWSLETTER_GROUP_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterUser')] = self::NEWSLETTER_USER_CHOICES;
		$options[self::getChoicesName('newsletterGroup')] = self::NEWSLETTER_GROUP_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterUserNewsletterGroupAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterUserNewsletterGroupAssignment();
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