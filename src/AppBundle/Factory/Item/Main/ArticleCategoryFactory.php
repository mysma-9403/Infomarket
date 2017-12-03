<?php

namespace AppBundle\Factory\Item\Main;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleCategoryFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ArticleCategory::class);
	}
}