<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockMagazineAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $magazineTransformer;

	public function __construct(EntityToNumberTransformer $newsletterBlockTransformer, 
			EntityToNumberTransformer $magazineTransformer) {
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->magazineTransformer = $magazineTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'alternativeName', 
				'label.newsletterBlockMagazineAssignment.alternativeName', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterBlockTransformer, 
				'newsletterBlock');
		$this->addTrueEntityChoiceField($builder, $options, $this->magazineTransformer, 'magazine');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterBlock')] = [ ];
		$options[self::getChoicesName('magazine')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}