<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Filter\Admin\Main\BenchmarkFieldFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFieldFilterType extends AdminFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('fieldName', TextType::class, array(
				'required' => false,
				'attr' => ['placeholder' => 'label.benchmarkField.fieldName']
		))
		;
		
		$this->addChoiceEntityFilterField($builder, $options, 'categories');
		$this->addChoiceNumberFilterField($builder, $options, 'fieldTypes');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('categories')] = [];
		$options[$this->getChoicesName('fieldTypes')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return BenchmarkFieldFilter::class;
	}
}