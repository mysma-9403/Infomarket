<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Branch;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchEditorType extends ImageEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addTextField($builder, 'icon', 'label.icon', false);
		$this->addTextField($builder, 'activeColor', 'label.activeColor');
		$this->addTextField($builder, 'color', 'label.color');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
	}

	protected function getEntityType() {
		return Branch::class;
	}
}