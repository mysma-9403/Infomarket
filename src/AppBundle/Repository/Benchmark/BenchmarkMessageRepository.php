<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class BenchmarkMessageRepository extends SimpleEntityRepository
{
	public function findItemsByAuthorAndProduct($authorId, $productId) {
		return $this->queryItemsByAuthorAndProduct($authorId, $productId)->getScalarResult();
	}
	
	protected function queryItemsByAuthorAndProduct($authorId, $productId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.content, e.state, IDENTITY(e.author), e.readByAuthor");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.author', $authorId));
		$where->add($expr->eq('e.product', $productId));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}
