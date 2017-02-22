<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;

class NewsletterGroupEditorType extends SimpleEntityEditorType
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}