<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Brand;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BrandEditorType extends ImageEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addTextField($builder, 'www', 'label.brand.www');
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
	}

	protected function getEntityType() {
		return Brand::class;
	}
}