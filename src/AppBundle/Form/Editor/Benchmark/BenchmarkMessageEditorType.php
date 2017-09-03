<?php

namespace AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Form\Base\EditorType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageEditorType extends EditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCKEditorField($builder, 'content', 'label.content');
	}

	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}