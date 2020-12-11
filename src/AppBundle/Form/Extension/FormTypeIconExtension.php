<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\FormType;

class FormTypeIconExtension extends AbstractIconExtension {

	public function getExtendedType() {
		return FormType::class;
	}
}