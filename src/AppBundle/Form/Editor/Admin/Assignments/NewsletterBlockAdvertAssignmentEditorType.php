<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockAdvertAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $advertTransformer;

	public function __construct(EntityToNumberTransformer $newsletterBlockTransformer, 
			EntityToNumberTransformer $advertTransformer) {
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->advertTransformer = $advertTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterBlockTransformer, 
				'newsletterBlock');
		$this->addTrueEntityChoiceField($builder, $options, $this->advertTransformer, 'advert');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterBlock')] = [];
		$options[self::getChoicesName('advert')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}
}