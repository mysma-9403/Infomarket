<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Branch;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchEditorType extends ImageEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addTextField($builder, 'icon', 'label.icon', false);
		$this->addTextField($builder, 'color', 'label.color');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
	}

	protected function getEntityType() {
		return Branch::class;
	}
}