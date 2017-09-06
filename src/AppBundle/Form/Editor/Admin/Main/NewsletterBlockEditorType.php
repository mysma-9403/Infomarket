<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterBlockEditorType extends SimpleEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterBlockTemplateTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $newsletterPageTransformer;

	public function __construct(EntityToNumberTransformer $newsletterBlockTemplateTransformer, 
			EntityToNumberTransformer $newsletterPageTransformer) {
		$this->newsletterBlockTemplateTransformer = $newsletterBlockTemplateTransformer;
		$this->newsletterPageTransformer = $newsletterPageTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addCheckboxField($builder, 'showTitle', 'label.showTitle');
		
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addIntegerField($builder, 'xAdvertRatio', 'label.newsletterBlock.xAdvertRatio');
		$this->addIntegerField($builder, 'yAdvertRatio', 'label.newsletterBlock.yAdvertRatio');
		
		$this->addIntegerField($builder, 'xArticleRatio', 'label.newsletterBlock.xArticleRatio');
		$this->addIntegerField($builder, 'yArticleRatio', 'label.newsletterBlock.yArticleRatio');
		
		$this->addIntegerField($builder, 'xMagazineRatio', 'label.newsletterBlock.xMagazineRatio');
		$this->addIntegerField($builder, 'yMagazineRatio', 'label.newsletterBlock.yMagazineRatio');
		
		$this->addIntegerField($builder, 'magazinePadding', 'label.newsletterBlock.magazinePadding');
		
		$this->addRawTextField($builder, 'articleSeparator', 'label.newsletterBlock.articleSeparator', false);
		$this->addRawTextField($builder, 'magazineSeparator', 'label.newsletterBlock.magazineSeparator', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterBlockTemplateTransformer, 
				'newsletterBlockTemplate');
		$this->addTrueEntityChoiceField($builder, $options, $this->newsletterPageTransformer, 'newsletterPage');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('newsletterBlockTemplate')] = [ ];
		$options[self::getChoicesName('newsletterPage')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}