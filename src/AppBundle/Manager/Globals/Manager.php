<?php
declare(strict_types=1);

namespace AppBundle\Manager\Globals;

use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Form\Base\SearchFilterType;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class Manager
{
    private $request;
    private $formFactory;
    private $em;

    public function __construct(RequestStack $request, FormFactory $formFactory, CategoryRepository $em)
    {
        $this->request = $request;
        $this->formFactory = $formFactory;
        $this->em = $em;
    }

    public function searchForm()
    {
        $searchFilter = new SearchFilter();
        $searchFilter->initRequestValues($this->request->getCurrentRequest());
        $searchFilterForm = $this->formFactory->create(SearchFilterType::class, $searchFilter);
        $searchFilterForm->handleRequest($this->request->getCurrentRequest());

        return $searchFilterForm->createView();
    }

    public function categories()
    {
        return $this->em->findMenuItems();
    }
}
