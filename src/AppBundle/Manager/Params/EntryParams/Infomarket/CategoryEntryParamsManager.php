<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Segment;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\ProductRepository;
use AppBundle\Repository\Infomarket\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var BrandRepository
	 */
	protected $brandRepository;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 *
	 * @var SegmentRepository
	 */
	protected $segmentRepository;

    /**
     * @var ArticleRepository
     */
	protected $articleRepository;

    /**
     * @var ArticleCategoryRepository
     */
	protected $articleCategoryRepository;

	public function __construct(EntityManager $em, FilterManager $fm, BrandRepository $brandRepository, 
			CategoryRepository $categoryRepository, ProductRepository $productRepository, 
			SegmentRepository $segmentRepository, ArticleRepository $articleRepository, ArticleCategoryRepository $articleCategoryRepository) {
		parent::__construct($em, $fm);
		
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
		$this->segmentRepository = $segmentRepository;
		$this->articleRepository = $articleRepository;
		$this->articleCategoryRepository = $articleCategoryRepository;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$viewParams['topBrands'] = $this->brandRepository->findTopItems($entry->getId());
		$viewParams['brands'] = $this->brandRepository->findRecommendedItems($entry->getId());
		
		$viewParams['segments'] = $segments = $this->segmentRepository->findTopItems();
		
		$viewParams['products'] = array();
		
		foreach ($segments as $segment) {
			$products = $this->productRepository->findTopItems($entry->getId(), $segment['id']);
			$viewParams['products'][$segment['id']] = $products;
		}
		
		$categories = $this->categoryRepository->findSubcategories($entry->getId());
		$viewParams['subcategories'] = $categories;
		
		$viewParams['subproducts'] = array();
		
		foreach ($categories as $category) {
			$viewParams['subproducts'][$category['id']] = array();
			
			foreach ($segments as $segment) {
				$products = $this->productRepository->findTopItems($category['id'], $segment['id']);
				$viewParams['subproducts'][$category['id']][$segment['id']] = $products;
			}
		}

        $articleCategories = $this->articleCategoryRepository->findHomeItems();
        $articleCategoriesIds = $this->articleCategoryRepository->getIds($articleCategories);

        $articles = [];
        if (count($categories) > 0) {
            $articles = $this->articleRepository->findHomeFeaturedItems($categories, $articleCategoriesIds, 3);
        }
        if (count($articles) > 0) {
            $articlesIds = $this->articleRepository->getIds($articles);
            $brands = $this->brandRepository->findItemsByArticles($articlesIds);
           // $articles = $this->abaManager->assignToItems($articles, $brands);
        }

        $viewParams['featuredArticles'] = $articles;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}
