<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Form\Editor\Admin\Main\LinkEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class LinkEditorTypeTest extends SimpleEditorTypeTest {
	
	const URL = 'http://krk-dev.com';
	
	
	
	protected function assertEntity($entity) {
		/** @var Link $entity */
		$this->assertSame(self::URL, $entity->getUrl());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
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