<?php

namespace AppBundle\Form\Filter\Admin\Base;

use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminFilterType extends FilterType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$this->addDateTimeField($builder, 'createdAfter', 'label.createdAfter', false);
		$this->addDateTimeField($builder, 'createdBefore', 'label.createdBefore', false);
		
		$this->addDateTimeField($builder, 'updatedAfter', 'label.updatedAfter', false);
		$this->addDateTimeField($builder, 'updatedBefore', 'label.updatedBefore', false);
		
		$this->addChoiceEntityFilterField($builder, $options, 'createdBy');
		$this->addChoiceEntityFilterField($builder, $options, 'updatedBy');
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[$this->getChoicesName('createdBy')] = [];
		$options[$this->getChoicesName('updatedBy')] = [];
	
		return $options;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return AuditFilter::class;
	}
}