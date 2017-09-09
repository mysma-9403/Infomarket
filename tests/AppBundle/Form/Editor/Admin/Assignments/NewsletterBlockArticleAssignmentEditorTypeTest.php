<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterBlockArticleAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterBlockArticleAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const NEWSLETTER_BLOCK_ID = 100;

	const NEWSLETTER_BLOCK_NAME = 'Test newsletterBlock';

	const NEWSLETTER_BLOCK_CHOICES = ['Test newsletterBlock' => self::NEWSLETTER_BLOCK_ID];

	const ARTICLE_ID = 100;

	const ARTICLE_NAME = 'Test article';

	const ARTICLE_CHOICES = ['Test article' => self::ARTICLE_ID];

	const ALTERNATIVE_NAME = 'Test name';

	const ALTERNATIVE_SUBNAME = 'Test subname';

	const ALTERNATIVE_BRANDS = 'Test brands';

	private $newsletterBlockTransformer;

	private $articleTransformer;

	protected function setUp() {
		$this->newsletterBlockTransformer = $this->getEntityTransformerMock($this->getNewsletterBlock(), 
				self::NEWSLETTER_BLOCK_ID);
		$this->articleTransformer = $this->getEntityTransformerMock($this->getArticle(), self::ARTICLE_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new NewsletterBlockArticleAssignmentEditorType($this->newsletterBlockTransformer, 
				$this->articleTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var NewsletterBlockArticleAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NEWSLETTER_BLOCK_ID, $entity->getNewsletterBlock()->getId());
		$this->assertSame(self::NEWSLETTER_BLOCK_NAME, $entity->getNewsletterBlock()->getName());
		
		$this->assertSame(self::ARTICLE_ID, $entity->getArticle()->getId());
		$this->assertSame(self::ARTICLE_NAME, $entity->getArticle()->getName());
		
		$this->assertSame(self::ALTERNATIVE_NAME, $entity->getAlternativeName());
		$this->assertSame(self::ALTERNATIVE_SUBNAME, $entity->getAlternativeSubname());
		$this->assertSame(self::ALTERNATIVE_BRANDS, $entity->getAlternativeBrands());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['newsletterBlock'] = self::NEWSLETTER_BLOCK_ID;
		$data['article'] = self::ARTICLE_ID;
		
		$data['alternativeName'] = self::ALTERNATIVE_NAME;
		$data['alternativeSubname'] = self::ALTERNATIVE_SUBNAME;
		$data['alternativeBrands'] = self::ALTERNATIVE_BRANDS;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('newsletterBlock')] = self::NEWSLETTER_BLOCK_CHOICES;
		$options[self::getChoicesName('article')] = self::ARTICLE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return NewsletterBlockArticleAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new NewsletterBlockArticleAssignment();
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