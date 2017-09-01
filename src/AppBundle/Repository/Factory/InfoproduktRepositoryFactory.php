<?php

namespace AppBundle\Repository\Factory;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Term;
use AppBundle\Repository\Infoprodukt\AdvertRepository;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use AppBundle\Repository\Infoprodukt\MagazineRepository;
use AppBundle\Repository\Infoprodukt\MenuEntryRepository;
use AppBundle\Repository\Infoprodukt\ProductRepository;
use AppBundle\Repository\Infoprodukt\SegmentRepository;
use AppBundle\Repository\Infoprodukt\TagRepository;
use AppBundle\Repository\Search\Infoprodukt\ArticleSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\BrandSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\CategorySearchRepository;
use AppBundle\Repository\Search\Infoprodukt\ProductSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\TermSearchRepository;
use Doctrine\Common\Persistence\ObjectManager;

class InfoproduktRepositoryFactory {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($class) {
		if ($class == AdvertRepository::class) {
			return new AdvertRepository($this->em, $this->em->getClassMetadata(Advert::class));
		}
		if ($class == ArticleRepository::class) {
			return new ArticleRepository($this->em, $this->em->getClassMetadata(Article::class));
		}
		if ($class == ArticleCategoryRepository::class) {
			return new ArticleCategoryRepository($this->em, $this->em->getClassMetadata(ArticleCategory::class));
		}
		if ($class == BrandRepository::class) {
			return new BrandRepository($this->em, $this->em->getClassMetadata(Brand::class));
		}
		if ($class == CategoryRepository::class) {
			return new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		}
		if ($class == MagazineRepository::class) {
			return new MagazineRepository($this->em, $this->em->getClassMetadata(Magazine::class));
		}
		if ($class == MenuEntryRepository::class) {
			return new MenuEntryRepository($this->em, $this->em->getClassMetadata(MenuEntry::class));
		}
		if ($class == ProductRepository::class) {
			return new ProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		}
		if ($class == SegmentRepository::class) {
			return new SegmentRepository($this->em, $this->em->getClassMetadata(Segment::class));
		}
		if ($class == TagRepository::class) {
			return new TagRepository($this->em, $this->em->getClassMetadata(Tag::class));
		}
		
		if ($class == ArticleSearchRepository::class) {
			return new ArticleSearchRepository($this->em, $this->em->getClassMetadata(Article::class));
		}
		if ($class == BrandSearchRepository::class) {
			return new BrandSearchRepository($this->em, $this->em->getClassMetadata(Brand::class));
		}
		if ($class == CategorySearchRepository::class) {
			return new CategorySearchRepository($this->em, $this->em->getClassMetadata(Category::class));
		}
		if ($class == ProductSearchRepository::class) {
			return new ProductSearchRepository($this->em, $this->em->getClassMetadata(Product::class));
		}
		if ($class == TermSearchRepository::class) {
			return new TermSearchRepository($this->em, $this->em->getClassMetadata(Term::class));
		}
		
		return null;
	}
}