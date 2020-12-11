<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportRatings;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportRatingsType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		$this->addRatingsFileField($builder, 'importFile', 'label.ratings.importFile');
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}

	protected function getEntityType() {
		return ImportRatings::class;
	}
}