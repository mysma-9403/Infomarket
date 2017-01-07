<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleCategoryEditorType extends ImageEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('subname', TextType::class, array(
					'required' => false
			))
		
			->add('featured', null, array(
					'required' => false
			))
			
			->add('infomarket', null, array(
					'required' => false
			))
			->add('infoprodukt', null, array(
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