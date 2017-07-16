<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Admin\Main\UserFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFilterType extends FilterType
{
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		parent::addMainFields($builder, $options);
		
		$builder
		->add('username', TextType::class, array(
				'attr' => array(
						'autofocus' => true,
						'placeholder' => 'label.user.username'
				),
				'required' => false
		))
		->add('surname', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.user.surname'
				),
				'required' => false
		))
		->add('forename', TextType::class, array(
				'attr' => array(
						'placeholder' => 'label.user.forename'
				),
				'required' => false
		))
		;
	}
	
	protected function getEntityType() {
		return UserFilter::class;
	}
}