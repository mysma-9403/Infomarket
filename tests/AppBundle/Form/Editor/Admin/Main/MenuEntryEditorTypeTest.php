<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Entity\Main\Page;
use AppBundle\Form\Editor\Admin\Main\MenuEntryEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class MenuEntryEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const ORDER_NUMBER = 76;

	const PARENT_ID = 10;

	const PARENT_NAME = 'Test name';

	const PARENT_CHOICES = ['Parent' => self::PARENT_ID];

	const PAGE_ID = 10;

	const PAGE_NAME = 'Test name';

	const PAGE_CHOICES = ['Parent' => self::PAGE_ID];

	const LINK_ID = 10;

	const LINK_NAME = 'Test name';

	const LINK_CHOICES = ['Parent' => self::LINK_ID];

	private $parentTransformer;

	private $pageTransformer;

	private $linkTransformer;

	protected function setUp() {
		$this->parentTransformer = $this->getEntityTransformerMock($this->getParent(), self::PARENT_ID);
		$this->pageTransformer = $this->getEntityTransformerMock($this->getPage(), self::PAGE_ID);
		$this->linkTransformer = $this->getEntityTransformerMock($this->getLink(), self::LINK_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new MenuEntryEditorType($this->parentTransformer, $this->pageTransformer, $this->linkTransformer);
		
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var MenuEntry $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		
		$this->assertSame(self::PARENT_ID, $entity->getParent()->getId());
		$this->assertSame(self::PARENT_NAME, $entity->getParent()->getName());
		
		$this->assertSame(self::PAGE_ID, $entity->getPage()->getId());
		$this->assertSame(self::PAGE_NAME, $entity->getPage()->getName());
		
		$this->assertSame(self::LINK_ID, $entity->getLink()->getId());
		$this->assertSame(self::LINK_NAME, $entity->getLink()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['parent'] = self::PARENT_ID;
		$data['page'] = self::PAGE_ID;
		$data['link'] = self::LINK_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('parent')] = self::PARENT_CHOICES;
		$options[self::getChoicesName('page')] = self::PAGE_CHOICES;
		$options[self::getChoicesName('link')] = self::LINK_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return MenuEntryEditorType::class;
	}

	protected function getEntity() {
		return new MenuEntry();
	}

	private function getParent() {
		$mock = new MenuEntry();
		$mock->setId(self::PARENT_ID);
		$mock->setName(self::PARENT_NAME);
		
		return $mock;
	}

	private function getPage() {
		$mock = new Page();
		$mock->setId(self::PAGE_ID);
		$mock->setName(self::PAGE_NAME);
		
		return $mock;
	}

	private function getLink() {
		$mock = new Link();
		$mock->setId(self::LINK_ID);
		$mock->setName(self::LINK_NAME);
		
		return $mock;
	}
}