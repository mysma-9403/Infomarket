<?php

namespace AppBundle\Form\Base;

use AppBundle\Filter\Common\SearchFilter;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchFilterType extends BaseType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
		->add('string', SearchType::class, array(
				'attr' => array(
						'autofocus' => true,
						'placeholder' => 'label.search.string'
				),
				'required' => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('search', SubmitType::class);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseType::getEntityType()
	 */
	protected function getEntityType() {
		return SearchFilter::class;
	}
}