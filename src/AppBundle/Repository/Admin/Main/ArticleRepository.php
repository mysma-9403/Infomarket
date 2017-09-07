<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment;
use AppBundle\Entity\Assignments\ArticleBrandAssignment;
use AppBundle\Entity\Assignments\ArticleCategoryAssignment;
use AppBundle\Entity\Main\Article;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Main\ArticleFilter;
use AppBundle\Repository\Admin\Base\ImageRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleRepository extends ImageRepository {

	/**
	 *
	 * @var boolean
	 */
	protected $archived = 0;
	

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		parent::buildJoins($builder, $filter);
		
		if (count($filter->getBrands()) > 0) {
			$builder->leftJoin(ArticleBrandAssignment::class, 'aba', Join::WITH, 'e.id = aba.article');
		}
		
		if (count($filter->getCategories()) > 0) {
			$builder->leftJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		}
		
		if (count($filter->getArticleCategories()) > 0) {
			$builder->leftJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 
					'e.id = aaca.article');
		}
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		parent::buildOrderBy($builder, $filter);
		
		$builder->addOrderBy('e.date', 'DESC');
		
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		$fields[] = 'e.featured';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$where->add($builder->expr()->eq('e.archived', $this->archived));
		$where->add('e.parent IS NULL');
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		$this->addStringWhere($builder, $where, 'e.subname', $filter->getSubname());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		$this->addBooleanWhere($builder, $where, 'e.featured', $filter->getFeatured());
		
		$this->addArrayWhere($builder, $where, 'aba.brand', $filter->getBrands());
		$this->addArrayWhere($builder, $where, 'aca.category', $filter->getCategories());
		$this->addArrayWhere($builder, $where, 'aaca.articleCategory', $filter->getArticleCategories());
		
		return $where;
	}

	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		parent::buildFilterOrderBy($builder);
		
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		$fields[] = $item['subname'];
		
		return $fields;
	}
	
	// TODO copied from common -> should be shared!
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
		
		$builder->select(
				'e.id, e.name, e.subname, e.image, e.intro, e.content, e.layout, IDENTITY(e.parent) AS parent, e.imageSize');
		$builder->from($this->getEntityType(), "e");
		
		$where = $expr->andX();
		$where->add($expr->eq('e.parent', $articleId));
		$where->add($expr->eq('e.page', $page));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Article::class;
	}
}
