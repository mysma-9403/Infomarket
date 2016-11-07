<?php

namespace AppBundle\Manager\Params\EntryParams\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleEntryParamsManager extends EntryParamsManager {
	
	public function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		
		$articleRepository = $this->doctrine->getRepository(Article::class);
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$tagRepository = $this->doctrine->getRepository(Tag::class);
		
		$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
		$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		$articleFilter->setParents([$entry]);
		$articleFilter->setLimit(1);
		$articleFilter->setOrderBy('e.page DESC');
		
		$lastSubarticle = $articleRepository->findSelected($articleFilter);
		if(count($lastSubarticle) > 0) $pages = $lastSubarticle[0]->getPage();
		else $pages = '1';
		
		$viewParams['pages'] = $pages;
		if($page > $pages) $page = '1';
		$viewParams['page'] = $page;
		
		
		
		$articleFilter->setPages($page);
		$articleFilter->setLimit(100);
		$articleFilter->setOrderBy('e.orderNumber ASC');
		
		$subarticles = $articleRepository->findSelected($articleFilter);
		$viewParams['subarticles'] = $subarticles;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}