<?php

namespace AppBundle\Form\Base;

use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class ListType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		$this->addFilterEntityChoiceField($builder, $options, 'entries', false, true, true);
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('selectAll', SubmitType::class)->add('selectNone', SubmitType::class)->add('deleteSelected', SubmitType::class);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('entries')] = [ ];
		
		return $options;
	}
}