<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportRatings;
use AppBundle\Form\Base\BaseType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportRatingsType extends BaseType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('importFile', ElFinderType::class, array(
					'instance'=>'ratings',
					'required' => true
			))
			;
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ImportRatings::class;
	}
}