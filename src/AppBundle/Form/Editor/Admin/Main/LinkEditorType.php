<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkEditorType extends SimpleEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addTextField($builder, 'url', 'label.link.url');
	}

	protected function getEntityType() {
		return Link::class;
	}
}