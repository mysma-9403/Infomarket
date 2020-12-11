<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportNewsletterUsersType extends BaseType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		$this->addNewsletterUsersFileField($builder, 'importFile', 'label.newsletterUser.importFile');
		
		$this->addTempEntityChoiceField($builder, $options, 'newsletterGroups', true, true);
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterGroups')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return ImportNewsletterUsers::class;
	}
}