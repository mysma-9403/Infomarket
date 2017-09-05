<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Main\NewsletterGroupEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class NewsletterGroupEditorTypeTest extends SimpleEditorTypeTest {
	
	protected function getFormType() {
		return NewsletterGroupEditorType::class;
	}
	
	protected function getEntity() {
		return new NewsletterGroup();
	}
}