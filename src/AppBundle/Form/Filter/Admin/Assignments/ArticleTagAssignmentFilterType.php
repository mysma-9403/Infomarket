<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\ArticleTagAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\AdminFilterType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentFilterType extends AdminFilterType
{	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$articles = $options['articles'];
		$tags = $options['tags'];
		
		$builder
		->add('articles', ChoiceType::class, array(
				'choices' 		=> $articles, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('tags', ChoiceType::class, array(
				'choices'		=> $tags, 
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['articles'] = array();
		$options['tags'] = array();
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleTagAssignmentFilter::class;
	}
}