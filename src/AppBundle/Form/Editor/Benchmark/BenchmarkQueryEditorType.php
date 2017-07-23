<?php

namespace AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Form\Base\EditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkQueryEditorType extends EditorType {
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('name', TextType::class, array(
				'required' => true
		))
		->add('content', TextType::class, array(
				'required' => false
		))
		->add('archived', CheckboxType::class, array(
				'required' => false
		))
		;
	}
	
	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}