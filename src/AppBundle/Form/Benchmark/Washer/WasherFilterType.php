<?php

namespace AppBundle\Form\Benchmark\Washer;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\Washer\WasherFilter;
use AppBundle\Form\Benchmark\ProductFilterType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class WasherFilterType extends ProductFilterType
{	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('minCapacity', NumberType::class, array(
				'attr' => ['placeholder' => 'label.washer.minCapacity'],
				'required' => false
		))
		->add('maxCapacity', NumberType::class, array(
				'attr' => ['placeholder' => 'label.washer.maxCapacity'],
				'required' => false
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return WasherFilter::class;
	}
}