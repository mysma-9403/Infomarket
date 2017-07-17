<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\ArticleCategoryFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryFilterType extends SimpleEntityFilterType
{
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		parent::addMoreFields($builder, $options);
		
		$builder
		->add('subname', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.subname'
				),
				'required' => false
		))
		;
		
		$this->addChoiceNumberFilterField($builder, $options, 'featured', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('featured')] = [];
		
		return $options;
	}
	
	protected function getEntityType() {
		return ArticleCategoryFilter::class;
	}
}