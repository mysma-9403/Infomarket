<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryEditorType extends ImageEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryToNumberTransformer;

	public function __construct(EntityToNumberTransformer $categoryToNumberTransformer) {
		$this->categoryToNumberTransformer = $categoryToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		$this->addCheckboxField($builder, 'featured', 'label.featured');
		$this->addCheckboxField($builder, 'preleaf', 'label.preleaf');
		$this->addCheckboxField($builder, 'benchmark', 'label.benchmark');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addTextField($builder, 'icon', 'label.icon', false);
		$this->addIconImageField($builder, 'iconImage', 'label.category.iconImage', false);
		$this->addFeaturedImageField($builder, 'featuredImage', 'label.category.featuredImage', false);
		
		$this->addCKEditorField($builder, 'content', 'label.content', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryToNumberTransformer, 'parent', false);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return Category::class;
	}
}