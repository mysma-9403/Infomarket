<?php

namespace AppBundle\Form\Filter\Infoprodukt;

use AppBundle\Form\Base\FilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Filter\Infoprodukt\Main\ArticleFilter;

class ArticleFilterType extends FilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$articleCategories = $options['articleCategories'];
		
		$builder
		->add('articleCategories', ChoiceType::class, array(
				'choices' 		=> $articleCategories, 
				'required'		=> false,
				'expanded'      => true,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['articleCategories'] = array();
	
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