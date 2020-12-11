<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\Main\Article;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class ArticleImageSizesFactory extends TwigChoicesFactory {

	public function __construct() {
		$this->items['label.article.imageSize.small'] = Article::SMALL_IMAGE;
		$this->items['label.article.imageSize.medium'] = Article::MEDIUM_IMAGE;
		$this->items['label.article.imageSize.large'] = Article::LARGE_IMAGE;
	}

	protected function getTwigFunctionName() {
		return 'articleImageSizeName';
	}
}