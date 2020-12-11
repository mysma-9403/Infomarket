<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Form\Editor\Admin\Main\LinkEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class LinkEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const URL = 'http://krk-dev.com';

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Link $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::URL, $entity->getUrl());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['url'] = self::URL;
		
		return $data;
	}

	protected function getFormType() {
		return LinkEditorType::class;
	}

	protected function getEntity() {
		return new Link();
	}
}