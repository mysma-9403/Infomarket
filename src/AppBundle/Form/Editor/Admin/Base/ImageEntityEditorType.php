<?php

namespace AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\ImageEntity;
use Symfony\Component\Form\FormBuilderInterface;

class ImageEntityEditorType extends SimpleEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFileField($builder, 'file', 'label.image.file', false);
		
		$this->addCheckboxField($builder, 'vertical', 'label.image.vertical');
		
		$this->addIntegerField($builder, 'forcedWidth', 'label.image.forcedWidth', false);
		$this->addIntegerField($builder, 'forcedHeight', 'label.image.forcedHeight', false);
	}

	protected function getEntityType() {
		return ImageEntity::class;
	}
}