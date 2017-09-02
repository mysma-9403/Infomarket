<?php

namespace AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\NewsletterBlockArticleAssignmentFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockArticleAssignmentFilterType extends SimpleEntityFilterType {

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterEntityChoiceField($builder, $options, 'newsletterBlocks');
		$this->addFilterEntityChoiceField($builder, $options, 'articles');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[$this->getChoicesName('newsletterBlocks')] = [ ];
		$options[$this->getChoicesName('articles')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlockArticleAssignmentFilter::class;
	}
}