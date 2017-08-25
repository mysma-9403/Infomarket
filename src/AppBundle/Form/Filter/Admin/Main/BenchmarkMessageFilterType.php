<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends SimpleEntityFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreMessages()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addEntityChoiceFilterField($builder, $options, 'products');
		$this->addEntityChoiceFilterField($builder, $options, 'authors');
		
		$this->addNumberChoiceFilterField($builder, $options, 'states');
		$this->addBooleanChoiceFilterField($builder, $options, 'readByAdmin');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('products')] = [];
		$options[$this->getChoicesName('authors')] = [];
		
		$options[$this->getChoicesName('states')] = [];
		$options[$this->getChoicesName('readByAdmin')] = [];
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkMessageFilter::class;
	}
}