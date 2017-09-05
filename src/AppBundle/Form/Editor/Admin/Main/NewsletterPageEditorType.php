<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Entity\Main\NewsletterPageTemplate;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterPageEditorType extends SimpleEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterPageTemplateToNumberTransformer;

	public function __construct(EntityToNumberTransformer $newsletterPageTemplateToNumberTransformer) {
		$this->newsletterPageTemplateToNumberTransformer = $newsletterPageTemplateToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterPageTemplateToNumberTransformer, 
				'newsletterPageTemplate');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterPageTemplate')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterPage::class;
	}
}