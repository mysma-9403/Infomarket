<?php

namespace AppBundle\Form\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryType extends BaseType
{
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('name', TextType::class, array(
				'required' => true
		))
		->add('content', TextType::class, array(
				'required' => false
		))
		;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('save', SubmitType::class);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}