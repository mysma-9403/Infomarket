<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Term;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

class SearchEntryParamsManager extends EntryParamsManager {
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		$tagRepository = $this->doctrine->getRepository(Tag::class);
		
		
		
		$simpleFilter = new SimpleEntityFilter($userRepository);
		$simpleFilter->setAddNameDecorators(true);
		$simpleFilter->initValues($request);
		$simpleFilter->setInfomarket(SimpleEntityFilter::TRUE_VALUES);
		
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$brands = $brandRepository->findSelected($simpleFilter);
		
		$viewParams['brands'] = $brands;
		
		
		
		$productRepository = $this->doctrine->getRepository(Product::class);
		$products = $productRepository->findSelected($simpleFilter);
		
		if(count($brands) > 0) {
			$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
			$productFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
			$productFilter->setBrands($brands);
			$products = array_merge($products, $productRepository->findSelected($productFilter));
		}
		
		$viewParams['products'] = $products;
		
		
		
		
		$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
		$articleFilter->setAddNameDecorators(true);
		$articleFilter->setName($simpleFilter->getName());
		$articleFilter->setInfomarket(SimpleEntityFilter::TRUE_VALUES);
		$articleFilter->setArchived(SimpleEntityFilter::FALSE_VALUES);
		$articleFilter->setMain(SimpleEntityFilter::TRUE_VALUES);
		
		$articleRepository = $this->doctrine->getRepository(Article::class);
		$articles = $articleRepository->findSelected($articleFilter);
		
		if(count($brands) > 0) {
			$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
			$articleFilter->setInfomarket(SimpleEntityFilter::TRUE_VALUES);
			$articleFilter->setArchived(SimpleEntityFilter::FALSE_VALUES);
			$articleFilter->setMain(SimpleEntityFilter::TRUE_VALUES);
			$articleFilter->setBrands($brands);
			$articles = array_merge($articles, $articleRepository->findSelected($articleFilter));
		}
		
		$viewParams['articles'] = $articles;
		
		
		
		$termRepository = $this->doctrine->getRepository(Term::class);
		$terms = $termRepository->findSelected($simpleFilter);
		
		$viewParams['terms'] = $terms;
		
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}