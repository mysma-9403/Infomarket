<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Article;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleEditorType extends ImageEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleToNumberTransformer;

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $userToNumberTransformer;

	public function __construct(EntityToNumberTransformer $articleToNumberTransformer, 
			EntityToNumberTransformer $userToNumberTransformer) {
		$this->articleToNumberTransformer = $articleToNumberTransformer;
		$this->userToNumberTransformer = $userToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		$this->addTextField($builder, 'subname', 'label.subname', false);
		
		$this->addCheckboxField($builder, 'infomarket', 'label.infomarket');
		$this->addCheckboxField($builder, 'infoprodukt', 'label.infoprodukt');
		$this->addCheckboxField($builder, 'featured', 'label.featured');
		$this->addCheckboxField($builder, 'archived', 'label.archived');
		
		$this->addIntegerField($builder, 'page', 'label.page');
		$this->addIntegerField($builder, 'orderNumber', 'label.orderNumber');
		
		$this->addCKEditorField($builder, 'intro', 'label.intro', false);
		$this->addCKEditorField($builder, 'content', 'label.content', false);
		
		$this->addDateTimeField($builder, 'date', 'label.article.date');
		$this->addDateTimeField($builder, 'endDate', 'label.article.endDate', false);
		
		$this->addNumberChoiceField($builder, $options, 'layout');
		$this->addNumberChoiceField($builder, $options, 'imageSize');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->articleToNumberTransformer, 'parent', false);
		$this->addTrueEntityChoiceField($builder, $options, $this->userToNumberTransformer, 'author', false);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [ ];
		$options[self::getChoicesName('author')] = [ ];
		
		$options[self::getChoicesName('layout')] = [ ];
		$options[self::getChoicesName('imageSize')] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return Article::class;
	}
}