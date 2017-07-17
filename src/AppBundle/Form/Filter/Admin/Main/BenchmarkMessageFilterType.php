<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreMessages()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$this->addChoiceEntityFilterField($builder, $options, 'products');
		$this->addChoiceEntityFilterField($builder, $options, 'authors');
		
		$this->addChoiceNumberFilterField($builder, $options, 'states');
		$this->addChoiceNumberFilterField($builder, $options, 'readByAdmin', false);
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