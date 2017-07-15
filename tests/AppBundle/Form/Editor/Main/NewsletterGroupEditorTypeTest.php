<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Main\NewsletterGroupEditorType;
use Tests\AppBundle\Form\Editor\Base\SimpleEntityEditorTypeTest;

class NewsletterGroupEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	protected function getFormType() {
		return NewsletterGroupEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterGroup();
	}
}