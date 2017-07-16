<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\Article;
use AppBundle\Factory\Common\Choices\Base\ChoicesFactory;

class ArticleLayoutsFactory implements ChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				Article::getLayoutName(Article::LEFT_LAYOUT) => Article::LEFT_LAYOUT,
				Article::getLayoutName(Article::MID_LAYOUT) => Article::MID_LAYOUT,
				Article::getLayoutName(Article::RIGHT_LAYOUT) => Article::RIGHT_LAYOUT,
				Article::getLayoutName(Article::BOTTOM_LAYOUT) => Article::BOTTOM_LAYOUT
		];
	}
	
}