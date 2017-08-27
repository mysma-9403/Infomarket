<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Main\ArticleFilter;
use AppBundle\Repository\Common\ArticleRepository as BaseArticleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ArticleRepository extends BaseArticleRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleFilter $filter */
		if (count($filter->getContextCategories()) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		}
		
		if (count($filter->getArticleCategories()) > 0) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
		
		$builder->leftJoin(User::class, 'u', Join::WITH, 'u.id = e.author');
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
		$fields[] = 'u.pseudonym AS authorPseudonym';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ArticleFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		$date = new \DateTime();
		
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		$this->addArrayWhere($builder, $where, 'aca.category', $filter->getContextCategories());
		$this->addArrayWhere($builder, $where, 'aaca.articleCategory', $filter->getArticleCategories());
		
		return $where;
	}

	protected function queryItemsIds($categories) {
		$date = new \DateTime();
		
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		if (count($categories) > 0) {
			$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		}
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		if (count($categories) > 0) {
			$where->add($builder->expr()->in('aca.category', $categories));
		}
		
		$builder->where($where);
		
		$builder->orderBy('e.date', 'DESC');
		$builder->groupBy('e.id');
		
		return $builder->getQuery();
	}

	public function findCategoryItems($categoriesIds, $articleCategory, $limit) {
		return $this->queryCategoryItems($categoriesIds, $articleCategory, $limit)->getScalarResult();
	}

	protected function queryCategoryItems($categoriesIds, $articleCategory, $limit) {
		$date = new \DateTime();
		
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ArticleCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.article');
		
		if ($articleCategory) {
			$builder->innerJoin(ArticleArticleCategoryAssignment::class, 'aaca', Join::WITH, 'e.id = aaca.article');
		}
		
		$expr = $builder->expr();
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.archived', 0));
		$where->add('e.parent IS NULL');
		
		$where->add('e.date IS NULL OR e.date <= \'' . $date->format('Y-m-d H:i') . "\'");
		$where->add('e.endDate IS NULL OR e.endDate >= \'' . $date->format('Y-m-d H:i') . "\'");
		
		if ($articleCategory) {
			$where->add($expr->eq('aaca.articleCategory', $articleCategory));
		}
		
		if (count($categoriesIds) > 0) {
			$where->add($expr->in('aca.category', $categoriesIds));
		}
		
		$builder->where($where);
		
		$builder->orderBy('e.date', 'DESC');
		$builder->groupBy('e.id');
		
		$builder->setMaxResults($limit);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Article::class;
	}
}
