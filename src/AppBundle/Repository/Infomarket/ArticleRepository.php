<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Main\ArticleFilter;
use AppBundle\Repository\Common\ArticleRepository as BaseArticleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleRepository extends BaseArticleRepository
{
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		if(count($filter->getCategories()) > 0 || count($filter->getContextCategories()) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = aca.category');
		}
		
		if(count($filter->getArticleCategories()) > 0) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.date', 'DESC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		$fields[] = 'e.date';
		$fields[] = 'e.intro';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		$expr = $builder->expr();
	
		$where->add($expr->eq('e.infomarket', 1));
		$where->add($expr->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		$date = new \DateTime();
		
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		if(count($filter->getCategories()) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $filter->getCategories()));
			$rootWhere->add($builder->expr()->in('c.id', $filter->getCategories()));
			
			$where->add($rootWhere);
		} else if(count($filter->getContextCategories()) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $filter->getContextCategories()));
			$rootWhere->add($builder->expr()->in('c.id', $filter->getContextCategories()));
			
			$where->add($rootWhere);
		}
		
		if(count($filter->getArticleCategories()) > 0) {
			$where->add($builder->expr()->in('aaca.articleCategory', $filter->getArticleCategories()));
		}
		
		$builder->where($where);
	
		return $where;
	}
	
	
	
	
	protected function queryItemsIds($categories)
	{
		$date = new \DateTime();
	
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		if(count($categories) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = aca.category');
		}
	
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
	
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
	
		if(count($categories) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $categories));
			$rootWhere->add($builder->expr()->in('c.id', $categories));
	
			$where->add($rootWhere);
		}
			
		$builder->where($where);
	
		$builder->addOrderBy('e.date', 'DESC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
			
		return $builder->getQuery();
	}
	
	
	
	public function findHomeFeaturedItems($categories, $articleCategories, $limit) {
		return $this->queryHomeFeaturedItems($categories, $articleCategories, $limit)->getScalarResult();
	}
	
	protected function queryHomeFeaturedItems($categories, $articleCategories, $limit) {
		$date = new \DateTime();
		
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		if(count($categories) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = aca.category');
		}
		
		if(count($articleCategories) > 0) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
		
		$expr = $builder->expr();
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add('e.parent IS NULL');
		
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		if(count($categories) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $categories));
			$rootWhere->add($builder->expr()->in('c.id', $categories));
		
			$where->add($rootWhere);
		}
		
		if(count($articleCategories) > 0) {
			$where->add($expr->in('aaca.articleCategory', $articleCategories));
		}
			
		$builder->where($where);
		
		$builder->addOrderBy('e.date', 'DESC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
		
		$builder->setMaxResults($limit);
			
		return $builder->getQuery();
	}
	
	public function findHomeTileItems($categories, $articleCategory, $limit) {
		return $this->queryHomeTileItems($categories, $articleCategory, $limit)->getScalarResult();
	}
	
	protected function queryHomeTileItems($categories, $articleCategory, $limit) {
		$date = new \DateTime();
	
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		if(count($categories) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = aca.category');
		}
	
		if($articleCategory) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
	
		$expr = $builder->expr();
	
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
	
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
	
		if(count($categories) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $categories));
			$rootWhere->add($builder->expr()->in('c.id', $categories));
	
			$where->add($rootWhere);
		}
	
		if($articleCategory) {
			$where->add($expr->eq('aaca.articleCategory', $articleCategory));
		}
			
		$builder->where($where);
	
		$builder->addOrderBy('e.date', 'DESC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	
		$builder->setMaxResults($limit);
			
		return $builder->getQuery();
	}
	
	public function findHomeListItems($categories, $articleCategory, $offset, $limit) {
		return $this->queryHomeListItems($categories, $articleCategory, $offset, $limit)->getScalarResult();
	}
	
	protected function queryHomeListItems($categories, $articleCategory, $offset, $limit) {
		$date = new \DateTime();
	
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		if(count($categories) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
			$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = aca.category');
		}
	
		if($articleCategory) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
	
		$expr = $builder->expr();
	
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
	
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
	
		if(count($categories) > 0) {
			$rootWhere = $builder->expr()->orX();
			$rootWhere->add($builder->expr()->in('c.rootId', $categories));
			$rootWhere->add($builder->expr()->in('c.id', $categories));
	
			$where->add($rootWhere);
		}
	
		if($articleCategory) {
			$where->add($expr->eq('aaca.articleCategory', $articleCategory));
		}
			
		$builder->where($where);
	
		$builder->addOrderBy('e.date', 'DESC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	
		$builder->setFirstResult($offset);
		$builder->setMaxResults($limit);
			
		return $builder->getQuery();
	}
}
