<?php

namespace AppBundle\Repository;

use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\ArticleCategory;

class ArticleCategoryRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleCategory::class;
	}
}
