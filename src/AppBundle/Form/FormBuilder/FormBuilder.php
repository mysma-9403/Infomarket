<?php

namespace AppBundle\Form\FormBuilder;

use Symfony\Component\Form\FormBuilderInterface;

interface FormBuilder {

	public function add(FormBuilderInterface &$builder, array $params, $options);
}