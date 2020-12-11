<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Main\NewsletterGroupEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterGroupEditorTypeTest extends SimpleEditorTypeTest {

	const NAME = 'Test name';

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var NewsletterGroup $entity */
		$this->assertSame(self::NAME, $entity->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		return $data;
	}

	protected function getFormType() {
		return NewsletterGroupEditorType::class;
	}

	protected function getEntity() {
		return new NewsletterGroup();
	}
}