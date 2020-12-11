<?php
declare(strict_types=1);

namespace AppBundle\Twig;

use AppBundle\Entity\Main\Category;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class GetCategoryByIdExtension extends AbstractExtension
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('get_category', [$this, 'getCategory']),
        ];
    }

    public function getCategory(int $categoryId)
    {
        /** @var Category $category */
        $category = $this->em->getRepository(Category::class)->find($categoryId);

        return $category->getSlugUrl();
    }
}
