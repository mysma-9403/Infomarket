<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Branch;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class BranchEditorType extends ImageEntityEditorType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
			->add('icon', null, array(
					'required' => false
			))
			->add('color', null, array(
					'required' => true
			))
			->add('orderNumber', IntegerType::class, array(
					'required' => true
			))
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Branch::class;
	}
}