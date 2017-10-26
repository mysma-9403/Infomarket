<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\Article;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(Article::class);
	}
}