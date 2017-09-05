<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlock;
use AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment;
use AppBundle\Entity\Assignments\Advert;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterBlockAdvertAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEditorTypeTest;

class NewsletterBlockAdvertAssignmentEditorTypeTest extends BaseEditorTypeTest {
		
	const NEWSLETTER_BLOCK_ID = 100;
	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';
	const NEWSLETTER_BLOCK_CHOICES = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];
	
	const ADVERT_ID = 100;
	const ADVERT_NAME = 'Test advert';
	const ADVERT_CHOICES = ['Test advert' => self::ADVERT_ID];
	
	
	
	private $newsletterBlockTransformer;
	
	private $advertTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getEntityTransformerMock($this->getNewsletterBlock(), self::NEWSLETTER_BLOCK_ID);
		$this->advertTransformer = $this->getEntityTransformerMock($this->getAdvert(), self::ADVERT_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockAdvertAssignmentEditorType($this->newsletterBlockTransformer, $this->advertTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockAdvertAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $entity->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $entity->getNewsletterBlock()->getName());
		
		$this->assertSame(self::ADVERT_ID, $entity->getAdvert()->getId());
		$this->assertSame(self::ADVERT_NAME, $entity->getAdvert()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterBlock'] = self::NEWSLETTER_BLOCK_ID;
		$data['advert'] = self::ADVERT_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterBlock')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('advert')] = self::ADVERT_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockAdvertAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockAdvertAssignment();
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