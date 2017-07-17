<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\ArticleFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleFilterType extends SimpleEntityFilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('subname', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.subname'
				),
				'required' => false
		))
		;
		
		$this->addChoiceEntityFilterField($builder, $options, 'brands');
		$this->addChoiceEntityFilterField($builder, $options, 'categories');
		$this->addChoiceEntityFilterField($builder, $options, 'articleCategories');
		
		$this->addChoiceNumberFilterField($builder, $options, 'featured', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('brands')] = [];
		$options[$this->getChoicesName('categories')] = [];
		$options[$this->getChoicesName('articleCategories')] = [];
		
		$options[$this->getChoicesName('featured')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleFilter::class;
	}
}