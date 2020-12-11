<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Main\Article;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class ArticleLayoutsFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.article.layout.left'] = Article::LEFT_LAYOUT;
		$this->items['label.article.layout.mid'] = Article::MID_LAYOUT;
		$this->items['label.article.layout.right'] = Article::RIGHT_LAYOUT;
		$this->items['label.article.layout.bottom'] = Article::BOTTOM_LAYOUT;
	}

	protected function getTwigFunctionName() {
		return 'articleLayoutName';
	}
}