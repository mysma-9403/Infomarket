<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterGroupEditorType extends SimpleEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
	}

	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}