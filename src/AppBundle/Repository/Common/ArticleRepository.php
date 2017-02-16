<?php

namespace AppBundle\Repository\Common;

use AppBundle\Entity\Article;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

abstract class ArticleRepository extends BaseRepository
{
	protected function getItemSelectFields(QueryBuilder &$builder) {
		$fields = parent::getItemSelectFields($builder);

		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}
	
	
	
	
	public function findLastPage($articleId) {
		return $this->queryLastPage($articleId)->getSingleScalarResult();
	}
	
	protected function queryLastPage($articleId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select($expr->max('e.page'));
		$builder->from($this->getEntityType(), "e");
		
		$where = $expr->orX();
		$where->add($expr->eq('e.id', $articleId));
		$where->add($expr->eq('e.parent', $articleId));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}
	
	
	
	public function findChildren($articleId, $page) {
		return $this->queryChildren($articleId, $page)->getScalarResult();
	}
	
	protected function queryChildren($articleId, $page) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select('e.id, e.name, e.subname, e.image, e.intro, e.content, e.layout, IDENTITY(e.parent) AS parent, e.imageSize');
		$builder->from($this->getEntityType(), "e");
	
		$where = $expr->andX();
		$where->add($expr->eq('e.parent', $articleId));
		$where->add($expr->eq('e.page', $page));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
	
	
	public function findItemsByIds($articlesIds) {
		return $this->queryItemsByIds($articlesIds)->getScalarResult();
	}
	
	public function queryItemsByIds($articlesIds)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical");
		$builder->from($this->getEntityType(), "e");
			
		$expr = $builder->expr();
		$builder->where($expr->in('e.id', $articlesIds));
	
		$builder->orderBy('e.date', 'DESC');
		$builder->orderBy('e.name', 'ASC');
		$builder->orderBy('e.subname', 'ASC');
			
		return $builder->getQuery();
	}
	
	
	




	public function findItemsIds($categories) {
		$items = $this->queryItemsIds($categories)->getScalarResult();
		return $this->getIds($items);
	}
	
	protected abstract function queryItemsIds($categories);
	
	
	
	public function assignItems($items, array $assignments, $type) {
		$size = count($items);
		for($i = 0; $i < $size; $i++) {
			$items[$i] = $this->assignItem($items[$i], $assignments, $type);
		}
	
		return $items;
	}
	
	public function assignItem(array $item, array $assignments, $type) {
		$itemAssignments = array();
		foreach ($assignments as $assignment) {
			if($assignment['article'] == $item['id']) {
				$itemAssignments[] = $assignment;
			}
		}
		$item[$type] = $itemAssignments;
	
		return $item;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Article::class ;
	}
}
