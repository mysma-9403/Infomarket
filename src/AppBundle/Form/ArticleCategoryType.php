<?php

namespace AppBundle\Form;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('featured', null, array(
					'required' => false
			))
			->add('subname', TextType::class, array(
					'required' => false
			))
			->add('orderNumber', NumberType::class, array(
					'required' => true
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleCategory::class;
	}
}