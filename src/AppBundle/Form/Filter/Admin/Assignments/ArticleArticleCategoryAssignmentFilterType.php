<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleArticleCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleArticleCategoryAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$articles = $options['articles'];
		$articleCategories = $options['articleCategories'];
		
		$builder
		->add('articles', ChoiceType::class, array(
				'choices' 		=> $articles, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('articleCategories', ChoiceType::class, array(
				'choices'		=> $articleCategories, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['articles'] = array();
		$options['articleCategories'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleArticleCategoryAssignmentFilter::class;
	}
}