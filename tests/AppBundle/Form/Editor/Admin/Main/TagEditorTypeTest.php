<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Tag;
use AppBundle\Form\Editor\Admin\Main\TagEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class TagEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Tag $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		return $data;
	}

	protected function getFormType() {
		return TagEditorType::class;
	}

	protected function getEntity() {
		return new Tag();
	}
}