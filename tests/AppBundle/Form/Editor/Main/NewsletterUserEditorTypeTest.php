<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Form\Editor\Main\NewsletterUserEditorType;
use Tests\AppBundle\Form\Editor\Base\SimpleEntityEditorTypeTest;

class NewsletterUserEditorTypeTest extends SimpleEntityEditorTypeTest {
	
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