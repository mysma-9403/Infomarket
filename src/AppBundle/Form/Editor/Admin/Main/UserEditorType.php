<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\User;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditorType extends BaseEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'username', 'label.user.username');
		
		$this->addTextField($builder, 'email', 'label.user.email');
		
		$this->addTextField($builder, 'forename', 'label.user.forename', false);
		$this->addTextField($builder, 'surname', 'label.user.surname', false);
		$this->addTextField($builder, 'pseudonym', 'label.user.pseudonym', false);
		
		$this->addNumberChoiceField($builder, $options, 'roles', true, true, true);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('roles')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return User::class;
	}
}