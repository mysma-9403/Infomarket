<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
			->add('featured', CheckboxType::class, array(
					'required' => false
			))
			->add('subname', TextType::class, array(
					'required' => false
			))
			->add('orderNumber', IntegerType::class, array(
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