<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserEditorType extends SimpleEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addCheckboxField($builder, 'subscribed', 'label.newsletterUser.subscribed');
	}

	protected function getEntityType() {
		return NewsletterUser::class;
	}
}