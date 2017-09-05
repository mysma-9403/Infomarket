<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Assignments\AdvertCategoryAssignment;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\Category;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Validator\Constraints\Date;

class AdvertRepository extends BaseRepository {

	public function findAdvertItems($location, $categories) {
		$result = $this->queryAdvertsIds($location, $categories)->getScalarResult();
		
		if (count($result) > 0) {
			shuffle($result);
			$result = array_slice($result, 0, 3);
			
			return $this->queryAdvertsByIds($this->getIds($result))->getScalarResult();
		}
		
		return array ();
	}

	protected function queryAdvertsIds($location, $categories) {
		$date = new \DateTime();
		
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		if (count($categories) > 0) {
			$builder->innerJoin(AdvertCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.advert');
		}
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.location', $location));
		
		$where->add('e.showLimit IS NULL OR e.showLimit <= 0 OR e.showCount <= e.showLimit');
		$where->add('e.clickLimit IS NULL OR e.clickLimit <= 0 OR e.clickCount <= e.clickLimit');
		$where->add('e.dateFrom IS NULL OR e.dateFrom <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.dateTo IS NULL OR e.dateTo >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		if (count($categories) > 0) {
			$where->add($builder->expr()->in('aca.category', $categories));
		}
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function queryAdvertsByIds($ids) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight");
		$builder->from($this->getEntityType(), "e");
		
		$builder->where($builder->expr()->in('e.id', $ids));
		
		return $builder->getQuery();
	}

	public function updateAdvertsShowCounts($ids) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->update(Advert::class, "e");
		$builder->set("e.showCount", "e.showCount+1");
		
		$builder->where($builder->expr()->in('e.id', $ids));
		
		return $builder->getQuery()->execute();
	}

	protected function getEntityType() {
		return Advert::class;
	}
}
