<?php

namespace AppBundle\Form;

use AppBundle\Entity\Page;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PageType extends ImageEntityType
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
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
			->add('orderNumber', NumberType::class, array(
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Page::class;
	}
}