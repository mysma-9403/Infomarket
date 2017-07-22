<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ArticleTagAssignments;
use AppBundle\Form\Base\BaseType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentsType extends BaseType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('tagsString', SearchType::class, array(
				'required' => false
		))
		;
		
		$this->addTempEntityChoiceEditorField($builder, $options, 'tags', false, true);
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('tags')] = [];
		
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleTagAssignments::class;
	}
}