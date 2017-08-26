<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineEditorType extends ImageEntityEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $magazineToNumberTransformer;

	public function __construct(EntityToNumberTransformer $magazineToNumberTransformer) {
		$this->magazineToNumberTransformer = $magazineToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		$this->addCheckboxField($builder, 'featured', 'label.featured');
		$this->addCheckboxField($builder, 'main', 'label.main');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addMagazineFileField($builder, 'magazineFile', 'label.magazine.magazineFile', false);
		
		$this->addDateTimeField($builder, 'date', 'label.magazine.date');
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->magazineToNumberTransformer, 'parent', false);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return Magazine::class;
	}
}