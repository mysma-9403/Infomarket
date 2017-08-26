<?php

namespace AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Form\Base\EditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryEditorType extends EditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addTextField($builder, 'content', 'label.content', false);
		
		$this->addCheckboxField($builder, 'archived', 'label.benchmarkQuery.archived');
	}

	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}