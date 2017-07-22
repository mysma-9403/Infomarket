<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Form\Editor\Admin\Main\NewsletterBlockEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorTypeTest;
use AppBundle\Entity\NewsletterPage;

class NewsletterBlockEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	const SUBNAME = 'Test subname';
	const ORDER_NUMBER = 99;
	const X_ADVERT_RATIO = 3;
	const Y_ADVERT_RATIO = 1;
	const X_ARTICLE_RATIO = 1;
	const Y_ARTICLE_RATIO = 1;
	const X_MAGAZINE_RATIO = 2;
	const Y_MAGAZINE_RATIO = 3;
	const MAGAZINE_PADDING = 5;
	const ARTICLE_SEPARATOR = ' - ';
	const MAGAZINE_SEPARATOR = ' - ';
	
	const NEWSLETTER_BLOCK_TEMPLATE_ID = 10;
	const NEWSLETTER_BLOCK_TEMPLATE_NAME = 'Template name';
	const NEWSLETTER_BLOCK_TEMPLATE_CHOICES = ['Test block template' => self::NEWSLETTER_BLOCK_TEMPLATE_ID];
	
	const NEWSLETTER_PAGE_ID = 102;
	const NEWSLETTER_PAGE_NAME = 'Page name';
	const NEWSLETTER_PAGE_CHOICES = ['Test page' => self::NEWSLETTER_PAGE_ID];
	
	
	private $newsletterBlockTemplateTransformer;
	
	private $newsletterPageTransformer;
	
	
	
	protected function setUp() {
		$this->newsletterBlockTemplateTransformer = $this->getNewsletterBlockTemplateTransformerMock();
		$this->newsletterPageTransformer = $this->getNewsletterPageTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new NewsletterBlockEditorType($this->newsletterBlockTemplateTransformer, $this->newsletterPageTransformer);
		
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterBlock $entity */
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		$this->assertSame(self::X_ADVERT_RATIO, $entity->getXAdvertRatio());
		$this->assertSame(self::Y_ADVERT_RATIO, $entity->getYAdvertRatio());
		$this->assertSame(self::X_ARTICLE_RATIO, $entity->getXArticleRatio());
		$this->assertSame(self::Y_ARTICLE_RATIO, $entity->getYArticleRatio());
		$this->assertSame(self::X_MAGAZINE_RATIO, $entity->getXMagazineRatio());
		$this->assertSame(self::Y_MAGAZINE_RATIO, $entity->getYMagazineRatio());
		$this->assertSame(self::MAGAZINE_PADDING, $entity->getMagazinePadding());
		$this->assertSame(self::ARTICLE_SEPARATOR, $entity->getArticleSeparator());
		$this->assertSame(self::MAGAZINE_SEPARATOR, $entity->getMagazineSeparator());
		
		$this->assertSame(self::NEWSLETTER_BLOCK_TEMPLATE_ID, $entity->getNewsletterBlockTemplate()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_TEMPLATE_NAME, $entity->getNewsletterBlockTemplate()->getName());
		
		$this->assertSame(self::NEWSLETTER_PAGE_ID, $entity->getNewsletterPage()->getId());
		$this->assertSame(self::NEWSLETTER_PAGE_NAME, $entity->getNewsletterPage()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['subname'] = self::SUBNAME;
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['xAdvertRatio'] = self::X_ADVERT_RATIO;
		$data['yAdvertRatio'] = self::Y_ADVERT_RATIO;
		$data['xArticleRatio'] = self::X_ARTICLE_RATIO;
		$data['yArticleRatio'] = self::Y_ARTICLE_RATIO;
		$data['xMagazineRatio'] = self::X_MAGAZINE_RATIO;
		$data['yMagazineRatio'] = self::Y_MAGAZINE_RATIO;
		$data['magazinePadding'] = self::MAGAZINE_PADDING;
		$data['articleSeparator'] = self::ARTICLE_SEPARATOR;
		$data['magazineSeparator'] = self::MAGAZINE_SEPARATOR;
		$data['newsletterBlockTemplate'] = self::NEWSLETTER_BLOCK_TEMPLATE_ID;
		$data['newsletterPage'] = self::NEWSLETTER_PAGE_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterBlockTemplate')] = self::NEWSLETTER_BLOCK_TEMPLATE_CHOICES;
		$options[self::getChoicesName('newsletterPage')] = self::NEWSLETTER_PAGE_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return NewsletterBlockEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterBlock();
	}
	
	
	
	private function getNewsletterBlockTemplateTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterBlockTemplate());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_BLOCK_TEMPLATE_ID);
	
		return $mock;
	}
	
	private function getNewsletterBlockTemplate() {
		$mock = new NewsletterBlockTemplate();
		$mock->setId(self::NEWSLETTER_BLOCK_TEMPLATE_ID);
		$mock->setName(self::NEWSLETTER_BLOCK_TEMPLATE_NAME);
	
		return $mock;
	}
	
	
	private function getNewsletterPageTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getNewsletterPage());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::NEWSLETTER_PAGE_ID);
	
		return $mock;
	}
	
	private function getNewsletterPage() {
		$mock = new NewsletterPage();
		$mock->setId(self::NEWSLETTER_PAGE_ID);
		$mock->setName(self::NEWSLETTER_PAGE_NAME);
	
		return $mock;
	}
}