<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Main\NewsletterGroupEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorTypeTest;

class NewsletterGroupEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	protected function getFormType() {
		return NewsletterGroupEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterGroup();
	}
}