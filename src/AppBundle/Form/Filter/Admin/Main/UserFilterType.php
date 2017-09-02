<?php

namespace AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\UserFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFilterType extends FilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'username', 'label.user.username');
		$this->addFilterTextField($builder, 'surname', 'label.user.surname');
		$this->addFilterTextField($builder, 'forename', 'label.user.forename');
	}

	protected function getEntityType() {
		return UserFilter::class;
	}
}