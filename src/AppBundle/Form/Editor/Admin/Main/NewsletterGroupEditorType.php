<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;

class NewsletterGroupEditorType extends SimpleEntityEditorType
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}