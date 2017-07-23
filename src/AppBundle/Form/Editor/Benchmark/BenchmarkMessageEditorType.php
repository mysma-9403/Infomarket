<?php

namespace AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Form\Base\EditorType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkMessageEditorType extends EditorType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('name', TextType::class, array(
				'required' => true
		))
		->add('content', CKEditorType::class, array(
				'config' => array('uiColor' => '#ffffff'),
				'required' => true
		))
		;
	}
	
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}