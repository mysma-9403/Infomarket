<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\ImportRatings;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportRatingsEditorType extends BaseEntityEditorType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('importFile', ElFinderType::class, array(
					'instance'=>'csv',
					'required' => true
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ImportRatings::class;
	}
}