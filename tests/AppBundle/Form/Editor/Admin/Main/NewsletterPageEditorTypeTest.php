<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Entity\Main\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Main\NewsletterPageEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterPageEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const SUBNAME = 'Test subname';

	const NEWSLETTER_PAGE_TEMPLATE_ID = 10;

	const NEWSLETTER_PAGE_TEMPLATE_NAME = 'Template name';

	const NEWSLETTER_PAGE_TEMPLATE_CHOICES = ['Test page template' => self::NEWSLETTER_PAGE_TEMPLATE_ID];

	private $newsletterPageTemplateTransformer;

	protected function setUp() {
		$this->newsletterPageTemplateTransformer = $this->getNewsletterPageTemplateTransformerMock();
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new NewsletterPageEditorType($this->newsletterPageTemplateTransformer);
		
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterPage $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::NEWSLETTER_PAGE_TEMPLATE_ID, $entity->getNewsletterPageTemplate()->getId());
		$this->assertSame(self::NEWSLETTER_PAGE_TEMPLATE_NAME, $entity->getNewsletterPageTemplate()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['newsletterPageTemplate'] = self::NEWSLETTER_PAGE_TEMPLATE_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterPageTemplate')] = self::NEWSLETTER_PAGE_TEMPLATE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return NewsletterPageEditorType::class;
	}

	protected function getEntity() {
		return new NewsletterPage();
	}

	private function getNewsletterPageTemplateTransformerMock() {
		$mock = $this->getMockBuilder(EntityToNumberTransformer::class)->disableOriginalConstructor()->getMock();
		
		$mock->expects($this->any())->method('reverseTransform')->willReturn($this->getNewsletterPageTemplate());
		$mock->expects($this->any())->method('transform')->willReturn(self::NEWSLETTER_PAGE_TEMPLATE_ID);
		
		return $mock;
	}

	private function getNewsletterPageTemplate() {
		$mock = new NewsletterPageTemplate();
		$mock->setId(self::NEWSLETTER_PAGE_TEMPLATE_ID);
		$mock->setName(self::NEWSLETTER_PAGE_TEMPLATE_NAME);
		
		return $mock;
	}
}