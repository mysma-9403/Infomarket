<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ProductEditorType extends ImageEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $brandToNumberTransformer;

	public function __construct(EntityToNumberTransformer $brandToNumberTransformer) {
		$this->brandToNumberTransformer = $brandToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		$this->addCheckboxField($builder, 'benchmark', 'label.benchmark');
		
		$this->addTopProduktImageField($builder, 'topProduktImage', 'label.product.topProduktImage', false);
		
		$this->addNumberField($builder, 'price', 'label.product.price', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->brandToNumberTransformer, 'brand');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('brand')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return Product::class;
	}
}