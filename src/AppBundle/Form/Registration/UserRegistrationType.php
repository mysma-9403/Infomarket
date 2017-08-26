<?php

namespace AppBundle\Form\Registration;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserRegistrationType extends AbstractType {
	
	// TODO check if can be BaseType'd
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('forename', TextType::class, array (
				'required' => true 
		))->add('surname', TextType::class, array (
				'required' => true 
		))->add('street', TextType::class, array (
				'required' => true 
		))->add('zipCode', TextType::class, array (
				'required' => true 
		))->add('city', TextType::class, array (
				'required' => true 
		))->add('digitalSubscription', CheckboxType::class, array (
				'required' => false 
		))->add('physicalSubscription', CheckboxType::class, array (
				'required' => false 
		))->add('dataProcessingAgreement', CheckboxType::class, array (
				'required' => true 
		));
	}

	public function getParent() {
		return RegistrationFormType::class;
	}

	public function getBlockPrefix() {
		return 'app_user_registration';
	}
}
