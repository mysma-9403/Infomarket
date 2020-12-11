<?php
declare(strict_types=1);

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Factory\Item\Infoprodukt\NewsletterUserFactory;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\CategoryEntryParamsManager;
use AppBundle\Manager\Route\RouteManager;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class CategoryInfoProduktController extends AbstractController
{
    const MAIN_AC = 17;

    private $em;
    private $routeManager;
    private $articleCategoryRepository;
    private $categoryRepository;
    private $articleRepository;
    private $categoryEntryParamsManager;

    public function __construct(EntityManagerInterface $em, RouteManager $routeManager, ArticleCategoryRepository $articleCategoryRepository, CategoryRepository $categoryRepository, ArticleRepository $articleRepository, CategoryEntryParamsManager $categoryEntryParamsManager)
    {
        $this->em = $em;
        $this->routeManager = $routeManager;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->categoryEntryParamsManager = $categoryEntryParamsManager;
    }

    public function indexAction(Request $request)
    {

        return $this->renderView('infoprodukt/category/index.html.twig');
    }

    public function showAction(Request $request, $id)
    {
        $articleCategories = $this->articleCategoryRepository->findHomeItems();
        $params = [];
        $params['domain'] = 'infoprodukt';
        $params['route'] = 'infoprodukt_category_show';

        $params['lastRouteParams'] = array();
        $params['contextParams'] = array();
        $params['routeParams'] = array();
        $params['viewParams'] = array();
        $params['routeParams'] = $this->routeManager->getLastRoute($request, ['route' => 'infoprodukt/category/index.html.twig', 'routeParams' => []]);

        $routeParams = $params['routeParams'];

        $routeParams['id'] = $id;

        $entry = $this->categoryRepository->find($id);
        $params['entry'] = $entry;

        $viewParams = $params['viewParams'];

        $params['viewParams'] = $viewParams;

        $params['viewParams'] = $viewParams;
        $params['routeParams'] = $routeParams;

        $params = $this->categoryEntryParamsManager->getShowParams($request,$params,$id);

        //TODO refactoring if method is such big that needs comments -> make smaller submethods instead of comments :P
        $params['viewParams']['mainCategory'] = $this->getArticleCategory($articleCategories, self::MAIN_AC);

        $articles = $this->articleRepository->findCategoryItems($params['contextParams'], self::MAIN_AC, 12);
        $params['viewParams']['mainArticles'] = $articles;


        return $this->renderView('infoprodukt/category/show.html.twig', $params['viewParams']);
    }

    private function getArticleCategory(array $articleCategories, $id) {
        foreach ($articleCategories as $articleCategory) {
            if ($articleCategory['id'] == $id) {
                return $articleCategory;
            }
        }
        return null;
    }
}
