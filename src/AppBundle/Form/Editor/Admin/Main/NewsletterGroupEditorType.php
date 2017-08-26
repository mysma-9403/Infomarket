<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterGroupEditorType extends SimpleEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
	}

	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}