<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Form\Base\BaseType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ImportNewsletterUsersType extends BaseType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('importFile', ElFinderType::class, array(
				'instance'=>'newsletter_users',
				'required' => true
		))
		;
		
		$this->addTempEntityChoiceEditorField($builder, $options, 'newsletterGroups', true, true);
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterGroups')] = [];
		
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ImportNewsletterUsers::class;
	}
}