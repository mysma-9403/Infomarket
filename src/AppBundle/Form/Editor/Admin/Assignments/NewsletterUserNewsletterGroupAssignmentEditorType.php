<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterUserTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterGroupTransformer;

	public function __construct(EntityToNumberTransformer $newsletterUserTransformer, 
			EntityToNumberTransformer $newsletterGroupTransformer) {
		$this->newsletterUserTransformer = $newsletterUserTransformer;
		$this->newsletterGroupTransformer = $newsletterGroupTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterUserTransformer, 'newsletterUser');
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterGroupTransformer, 
				'newsletterGroup');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterUser')] = [];
		$options[self::getChoicesName('newsletterGroup')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}