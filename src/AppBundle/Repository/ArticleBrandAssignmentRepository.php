<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Repository\Base\BaseEntityRepository;

/**
 * ArticleBrandAssignmentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleBrandAssignmentRepository extends BaseEntityRepository
{
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleBrandAssignment::class ;
	}
}