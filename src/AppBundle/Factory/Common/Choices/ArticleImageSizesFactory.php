<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\Article;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class ArticleImageSizesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				Article::getImageSizeName(Article::SMALL_IMAGE) => Article::SMALL_IMAGE,
				Article::getImageSizeName(Article::MEDIUM_IMAGE) => Article::MEDIUM_IMAGE,
				Article::getImageSizeName(Article::LARGE_IMAGE) => Article::LARGE_IMAGE
		];
	}
	
}