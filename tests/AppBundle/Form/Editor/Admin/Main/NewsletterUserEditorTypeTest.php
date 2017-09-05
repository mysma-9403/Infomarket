<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Form\Editor\Admin\Main\NewsletterUserEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterUserEditorTypeTest extends SimpleEditorTypeTest {
	
	const SUBSCRIBED = true;
	
	
	
	protected function assertEntity($entity) {
		/** @var NewsletterUser $entity */
		$this->assertSame(self::SUBSCRIBED, $entity->getSubscribed());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['subscribed'] = self::SUBSCRIBED;
		
		return $data;
	}
	
	protected function getFormType() {
		return NewsletterUserEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterUser();
	}
}