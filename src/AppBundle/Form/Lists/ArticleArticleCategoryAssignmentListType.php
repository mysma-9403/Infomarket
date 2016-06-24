<?php

namespace AppBundle\Form\Lists;

use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Form\Lists\Base\BaseEntityListType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleArticleCategoryAssignmentListType extends BaseEntityListType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('entries', EntityType::class, array(
					'class'			=> $this->getChoiceType(),
					'choice_label' 	=> 'articleCategory.name',
					'choices'		=> $options['choices'],
					'expanded'      => true,
					'multiple'      => true
			));
	}
	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return ArticleArticleCategoryAssignment::class;
	}
}