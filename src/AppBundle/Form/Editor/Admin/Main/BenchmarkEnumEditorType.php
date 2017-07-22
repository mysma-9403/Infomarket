<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEnumEditorType extends BaseEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('name', TextType::class, array(
				'required' => true,
				'attr' => ['placeholder' => 'label.benchmarkEnum.name']
		))
		->add('value', IntegerType::class, array(
				'required' => true,
				'attr' => ['placeholder' => 'label.benchmarkEnum.value']
		))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}