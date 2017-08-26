<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Page;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class PageEditorType extends ImageEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addCKEditorField($builder, 'content', 'label.content');
	}

	protected function getEntityType() {
		return Page::class;
	}
}