<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractIconExtension extends AbstractTypeExtension {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->setAttribute('icon', $options['icon']);
	}

	public function buildView(FormView $view, FormInterface $form, array $options) {
		$view->vars['icon'] = $options['icon'];
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array('icon' => null));
	}
}