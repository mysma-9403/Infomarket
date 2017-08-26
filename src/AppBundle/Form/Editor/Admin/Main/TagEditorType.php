<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class TagEditorType extends SimpleEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
	}

	protected function getEntityType() {
		return Tag::class;
	}
}