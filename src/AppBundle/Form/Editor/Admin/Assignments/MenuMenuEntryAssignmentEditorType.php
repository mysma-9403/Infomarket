<?php

namespace AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MenuMenuEntryAssignmentEditorType extends BaseEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $menuEntryTransformer;

	public function __construct(EntityToNumberTransformer $menuTransformer, EntityToNumberTransformer $menuEntryTransformer) {
		$this->menuTransformer = $menuTransformer;
		$this->menuEntryTransformer = $menuEntryTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->menuTransformer, 'menu');
		$this->addTrueEntityChoiceField($builder, $options, $this->menuEntryTransformer, 'menuEntry');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('menu')] = [ ];
		$options[self::getChoicesName('menuEntry')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}