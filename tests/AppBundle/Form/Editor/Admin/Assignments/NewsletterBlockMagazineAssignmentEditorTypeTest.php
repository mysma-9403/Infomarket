<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterBlockMagazineAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class NewsletterBlockMagazineAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const NEWSLETTER_BLOCK_ID = 100;
	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';
	const NEWSLETTER_BLOCK_CHOICES = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];
	
	const MAGAZINE_ID = 100;
	const MAGAZINE_NAME = 'Test magazine';
	const MAGAZINE_CHOICES = ['Test magazine' => self::MAGAZINE_ID];
	
	const ALTERNATIVE_NAME = 'Test name';
	
	
	
	private $newsletterBlockTransformer;
	
	private $magazineTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getEntityTransformerMock($this->getNewsletterBlock(), self::NEWSLETTER_BLOCK_ID);
		$this->magazineTransformer = $this->getEntityTransformerMock($this->getMagazine(), self::MAGAZINE_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockMagazineAssignmentEditorType($this->newsletterBlockTransformer, $this->magazineTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlockMagazineAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $entity->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $entity->getNewsletterBlock()->getName());
		
		$this->assertSame(self::MAGAZINE_ID, $entity->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $entity->getMagazine()->getName());
		
		$this->assertSame(self::ALTERNATIVE_NAME, $entity->getAlternativeName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['newsletterBlock'] = self::NEWSLETTER_BLOCK_ID;
		$data['magazine'] = self::MAGAZINE_ID;
		
		$data['alternativeName'] = self::ALTERNATIVE_NAME;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('newsletterBlock')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('magazine')] = self::MAGAZINE_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockMagazineAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlockMagazineAssignment();
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