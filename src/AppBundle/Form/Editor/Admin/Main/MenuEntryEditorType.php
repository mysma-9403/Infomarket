<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Entity\Main\Page;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MenuEntryEditorType extends SimpleEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $parentToNumberTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $pageToNumberTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $linkToNumberTransformer;

	public function __construct(EntityToNumberTransformer $parentToNumberTransformer, 
			EntityToNumberTransformer $pageToNumberTransformer, 
			EntityToNumberTransformer $linkToNumberTransformer) {
		$this->parentToNumberTransformer = $parentToNumberTransformer;
		$this->pageToNumberTransformer = $pageToNumberTransformer;
		$this->linkToNumberTransformer = $linkToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->parentToNumberTransformer, 'parent', false);
		$this->addTrueEntityChoiceField($builder, $options, $this->pageToNumberTransformer, 'page', false);
		$this->addTrueEntityChoiceField($builder, $options, $this->linkToNumberTransformer, 'link', false);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [ ];
		$options[self::getChoicesName('page')] = [ ];
		$options[self::getChoicesName('link')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return MenuEntry::class;
	}
}