<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\ArticleBrandAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleBrandAssignmentEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $brandTransformer;

	public function __construct(EntityToNumberTransformer $articleTransformer, 
			EntityToNumberTransformer $brandTransformer) {
		$this->articleTransformer = $articleTransformer;
		$this->brandTransformer = $brandTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->articleTransformer, 'article');
		$this->addTrueEntityChoiceField($builder, $options, $this->brandTransformer, 'brand');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('article')] = [ ];
		$options[self::getChoicesName('brand')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ArticleBrandAssignment::class;
	}
}