<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ButtonTypeIconExtension extends AbstractIconExtension {

	public function getExtendedType() {
		return ButtonType::class;
	}
}