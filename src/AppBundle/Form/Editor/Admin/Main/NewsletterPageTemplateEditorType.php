<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageTemplateEditorType extends SimpleEditorType {

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