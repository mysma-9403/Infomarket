<?php

namespace AppBundle\Form\Filter\Infomarket;

use AppBundle\Form\Base\FilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Filter\Infomarket\Main\ArticleFilter;

class ArticleFilterType extends FilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$articleCategories = $options['articleCategories'];
		$categories = $options['categories'];
		
		$builder
		->add('articleCategories', ChoiceType::class, array(
				'choices' 		=> $articleCategories, 
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true
		))
		->add('categories', ChoiceType::class, array(
				'choices'		=> $categories, 
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['articleCategories'] = array();
		$options['categories'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleFilter::class;
	}
}