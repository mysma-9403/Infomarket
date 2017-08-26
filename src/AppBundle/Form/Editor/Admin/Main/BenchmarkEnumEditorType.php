<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Form\Editor\Admin\Base\BaseEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEnumEditorType extends BaseEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.benchmarkEnum.name');
		$this->addIntegerField($builder, 'value', 'label.benchmarkEnum.value');
	}

	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}