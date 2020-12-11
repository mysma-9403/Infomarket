<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Term;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class TermEditorType extends SimpleEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
	}

	protected function getEntityType() {
		return Term::class;
	}
}