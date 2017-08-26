<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockTemplateEditorType extends SimpleEntityEditorType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addTextareaField($builder, 'style', 'label.newsletterBlockTemplate.style', false);
		
		$this->addTextareaField($builder, 'content', 'label.content');
		
		$this->addTextareaField($builder, 'advertContent', 'label.newsletterBlockTemplate.advertContent', false);
		$this->addTextareaField($builder, 'articleContent', 'label.newsletterBlockTemplate.articleContent', false);
		$this->addTextareaField($builder, 'magazineContent', 'label.newsletterBlockTemplate.magazineContent', false);
	}

	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
}