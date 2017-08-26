<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class SegmentEditorType extends ImageEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addTextField($builder, 'color', 'label.segment.color');
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
	}

	protected function getEntityType() {
		return Segment::class;
	}
}