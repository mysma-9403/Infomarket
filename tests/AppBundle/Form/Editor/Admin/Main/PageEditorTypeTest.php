<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Page;
use AppBundle\Form\Editor\Admin\Main\PageEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class PageEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const SUBNAME = 'Test subname';

	const SHOW_TITLE = true;

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const CONTENT = 'Test content';

	protected function getExtensions() {
		return array(new PreloadedExtension(array($this->getCKEditor()), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Page $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::SHOW_TITLE, $entity->getShowTitle());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::CONTENT, $entity->getContent());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['showTitle'] = self::SHOW_TITLE;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['content'] = self::CONTENT;
		
		return $data;
	}

	protected function getFormType() {
		return PageEditorType::class;
	}

	protected function getEntity() {
		return new Page();
	}
}