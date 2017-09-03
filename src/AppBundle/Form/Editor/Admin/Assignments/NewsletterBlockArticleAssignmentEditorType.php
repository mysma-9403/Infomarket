<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockArticleAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleTransformer;

	public function __construct(EntityToNumberTransformer $newsletterBlockTransformer, 
			EntityToNumberTransformer $articleTransformer) {
		$this->newsletterBlockTransformer = $newsletterBlockTransformer;
		$this->articleTransformer = $articleTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'alternativeName', 
				'label.newsletterBlockArticleAssignment.alternativeName', false);
		$this->addTextField($builder, 'alternativeSubname', 
				'label.newsletterBlockArticleAssignment.alternativeSubname', false);
		$this->addTextField($builder, 'alternativeBrands', 
				'label.newsletterBlockArticleAssignment.alternativeBrands', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterBlockTransformer, 
				'newsletterBlock');
		$this->addTrueEntityChoiceField($builder, $options, $this->articleTransformer, 'article');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterBlock')] = [ ];
		$options[self::getChoicesName('article')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}