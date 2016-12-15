<?php

namespace AppBundle\Form;

use AppBundle\Entity\ImportRatings;
use AppBundle\Form\Base\BaseFormType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportRatingsType extends BaseFormType
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