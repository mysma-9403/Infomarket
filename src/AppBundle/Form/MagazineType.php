<?php

namespace AppBundle\Form;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Base\ImageEntityType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineType extends ImageEntityType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('orderNumber', null, array(
					'required' => true
			))
			->add('magazineFile', ElFinderType::class, array(
					'instance'=>'magazine',
					'required' => true
			))
			->add('featured', null, array(
					'required' => false
			))
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}