<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Advert;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertEditorType extends ImageEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addDateTimeField($builder, 'dateFrom', 'label.advert.dateFrom', false);
		$this->addDateTimeField($builder, 'dateTo', 'label.advert.dateTo', false);
		
		$this->addTextField($builder, 'link', 'label.advert.link');
		
		$this->addIntegerField($builder, 'showLimit', 'label.advert.showLimit', false);
		$this->addIntegerField($builder, 'clickLimit', 'label.advert.clickLimit', false);
		
		$this->addNumberChoiceField($builder, $options, 'location');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('location')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return Advert::class;
	}
}