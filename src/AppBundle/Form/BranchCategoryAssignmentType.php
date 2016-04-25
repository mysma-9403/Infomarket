<?php

namespace AppBundle\Form;

use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Branch;

class BranchCategoryAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('branch', EntityType::class, array(
					'class'			=> Branch::class,
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose branch'
			))
			->add('category', EntityType::class, array(
					'class'			=> Category::class,
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose category'
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}