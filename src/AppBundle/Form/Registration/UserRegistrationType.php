<?php

namespace AppBundle\Form\Registration;

use AppBundle\Utils\RegexUtils;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationType extends AbstractType {

	/**
	 *
	 * @var RegexUtils
	 */
	protected $regexUtils;

	public function __construct(RegexUtils $regexUtils) {
		$this->regexUtils = $regexUtils;
	}
	
	// TODO check if can be BaseType'd
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('forename', TextType::class, array('required' => true));
		$builder->add('surname', TextType::class, array('required' => true));
		
		$builder->add('street', TextType::class, 
				array('required' => true, 'constraints' => $this->getStreetConstraints()));
		$builder->add('zipCode', TextType::class, 
				array('required' => true, 'constraints' => $this->getZipCodeConstraints()));
		$builder->add('city', TextType::class, 
				array('required' => true, 'constraints' => $this->getCityConstraints()));
		
		$builder->add('digitalSubscription', CheckboxType::class, array('required' => false));
		$builder->add('physicalSubscription', CheckboxType::class, array('required' => false));
		$builder->add('dataProcessingAgreement', CheckboxType::class, array('required' => true));
	}

	protected function getStreetConstraints() {
		return array(new NotBlank());
	}

	protected function getZipCodeConstraints() {
		return array(new NotBlank(), $this->regexUtils->getZipCodeRegex());
	}

	protected function getCityConstraints() {
		return array(new NotBlank(), $this->regexUtils->getPlainStringRegex());
	}

	public function getParent() {
		return RegistrationFormType::class;
	}

	public function getBlockPrefix() {
		return 'app_user_registration';
	}
}
