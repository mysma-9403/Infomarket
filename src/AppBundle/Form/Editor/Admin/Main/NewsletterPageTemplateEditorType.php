<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageTemplateEditorType extends SimpleEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addTextareaField($builder, 'style', 'label.newsletterPageTemplate.style', false);
		
		$this->addTextareaField($builder, 'content', 'label.content');
	}

	protected function getEntityType() {
		return NewsletterPageTemplate::class;
	}
}