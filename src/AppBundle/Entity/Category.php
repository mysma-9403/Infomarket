<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\ImageEntityTree;

/**
 * Category
 */
class Category extends ImageEntityTree
{
	const WASHER = 11;
	const CENTRIFUGE = 12;
	const WASHER_CENTRIFUGE = 13;
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		return 'uploads/categories';
	}
	
	public function getDefaultIMChildCategory() {
		
		foreach ($this->getChildren() as $child) {
			if($child->getInfomarket())
				return $child;
		}
		
		return null;
	}
	
	public function getDefaultIPChildCategory() {
	
		foreach ($this->getChildren() as $child) {
			if($child->getInfoprodukt())
				return $child;
		}
	
		return null;
	}
	
	public function getDisplayName() {
		$result = '<empty>';
		if($this->name) $result = $this->name;
		
		if($this->subname) {
			if($result == '<empty>')
				$result = $this->subname;
			else 
				$result .= ' ' . $this->subname;
		}
	
		return $result;
	}
	
    /**
     * @var string
     */
    private $subname;

    /**
     * @var integer
     */
    private $orderNumber;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $featuredImage;

    /**
     * @var boolean
     */
    private $featured;

    /**
     * @var boolean
     */
    private $preleaf;

    /**
     * @var string
     */
    private $content;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $articleCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $branchCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $brandCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articleCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->branchCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->brandCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set subname
     *
     * @param string $subname
     *
     * @return Category
     */
    public function setSubname($subname)
    {
        $this->subname = $subname;

        return $this;
    }

    /**
     * Get subname
     *
     * @return string
     */
    public function getSubname()
    {
        return $this->subname;
    }

    /**
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Category
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return integer
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return Category
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set featuredImage
     *
     * @param string $featuredImage
     *
     * @return Category
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * Get featuredImage
     *
     * @return string
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * Set featured
     *
     * @param boolean $featured
     *
     * @return Category
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * Get featured
     *
     * @return boolean
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * Set preleaf
     *
     * @param boolean $preleaf
     *
     * @return Category
     */
    public function setPreleaf($preleaf)
    {
        $this->preleaf = $preleaf;

        return $this;
    }

    /**
     * Get preleaf
     *
     * @return boolean
     */
    public function getPreleaf()
    {
        return $this->preleaf;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Category
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild(\AppBundle\Entity\Category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Category $child
     */
    public function removeChild(\AppBundle\Entity\Category $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add articleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment
     *
     * @return Category
     */
    public function addArticleCategoryAssignment(\AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment)
    {
        $this->articleCategoryAssignments[] = $articleCategoryAssignment;

        return $this;
    }

    /**
     * Remove articleCategoryAssignment
     *
     * @param \AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment
     */
    public function removeArticleCategoryAssignment(\AppBundle\Entity\ArticleCategoryAssignment $articleCategoryAssignment)
    {
        $this->articleCategoryAssignments->removeElement($articleCategoryAssignment);
    }

    /**
     * Get articleCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleCategoryAssignments()
    {
        return $this->articleCategoryAssignments;
    }

    /**
     * Add branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     *
     * @return Category
     */
    public function addBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments[] = $branchCategoryAssignment;

        return $this;
    }

    /**
     * Remove branchCategoryAssignment
     *
     * @param \AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment
     */
    public function removeBranchCategoryAssignment(\AppBundle\Entity\BranchCategoryAssignment $branchCategoryAssignment)
    {
        $this->branchCategoryAssignments->removeElement($branchCategoryAssignment);
    }

    /**
     * Get branchCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBranchCategoryAssignments()
    {
        return $this->branchCategoryAssignments;
    }

    /**
     * Add brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     *
     * @return Category
     */
    public function addBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments[] = $brandCategoryAssignment;

        return $this;
    }

    /**
     * Remove brandCategoryAssignment
     *
     * @param \AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment
     */
    public function removeBrandCategoryAssignment(\AppBundle\Entity\BrandCategoryAssignment $brandCategoryAssignment)
    {
        $this->brandCategoryAssignments->removeElement($brandCategoryAssignment);
    }

    /**
     * Get brandCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBrandCategoryAssignments()
    {
        return $this->brandCategoryAssignments;
    }

    /**
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Category
     */
    public function addProductCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment)
    {
        $this->productCategoryAssignments[] = $productCategoryAssignment;

        return $this;
    }

    /**
     * Remove productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     */
    public function removeProductCategoryAssignment(\AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment)
    {
        $this->productCategoryAssignments->removeElement($productCategoryAssignment);
    }

    /**
     * Get productCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductCategoryAssignments()
    {
        return $this->productCategoryAssignments;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\AppBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $advertCategoryAssignments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $termCategoryAssignments;


    /**
     * Add advertCategoryAssignment
     *
     * @param \AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment
     *
     * @return Category
     */
    public function addAdvertCategoryAssignment(\AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment)
    {
        $this->advertCategoryAssignments[] = $advertCategoryAssignment;

        return $this;
    }

    /**
     * Remove advertCategoryAssignment
     *
     * @param \AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment
     */
    public function removeAdvertCategoryAssignment(\AppBundle\Entity\AdvertCategoryAssignment $advertCategoryAssignment)
    {
        $this->advertCategoryAssignments->removeElement($advertCategoryAssignment);
    }

    /**
     * Get advertCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvertCategoryAssignments()
    {
        return $this->advertCategoryAssignments;
    }

    /**
     * Add termCategoryAssignment
     *
     * @param \AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment
     *
     * @return Category
     */
    public function addTermCategoryAssignment(\AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment)
    {
        $this->termCategoryAssignments[] = $termCategoryAssignment;

        return $this;
    }

    /**
     * Remove termCategoryAssignment
     *
     * @param \AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment
     */
    public function removeTermCategoryAssignment(\AppBundle\Entity\TermCategoryAssignment $termCategoryAssignment)
    {
        $this->termCategoryAssignments->removeElement($termCategoryAssignment);
    }

    /**
     * Get termCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTermCategoryAssignments()
    {
        return $this->termCategoryAssignments;
    }
    /**
     * @var string
     */
    private $iconImage;


    /**
     * Set iconImage
     *
     * @param string $iconImage
     *
     * @return Category
     */
    public function setIconImage($iconImage)
    {
        $this->iconImage = $iconImage;

        return $this;
    }

    /**
     * Get iconImage
     *
     * @return string
     */
    public function getIconImage()
    {
        return $this->iconImage;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $magazineCategoryAssignments;


    /**
     * Add magazineCategoryAssignment
     *
     * @param \AppBundle\Entity\MagazineCategoryAssignments $magazineCategoryAssignment
     *
     * @return Category
     */
    public function addMagazineCategoryAssignment(\AppBundle\Entity\MagazineCategoryAssignment $magazineCategoryAssignment)
    {
        $this->magazineCategoryAssignments[] = $magazineCategoryAssignment;

        return $this;
    }

    /**
     * Remove magazineCategoryAssignment
     *
     * @param \AppBundle\Entity\MagazineCategoryAssignments $magazineCategoryAssignment
     */
    public function removeMagazineCategoryAssignment(\AppBundle\Entity\MagazineCategoryAssignment $magazineCategoryAssignment)
    {
        $this->magazineCategoryAssignments->removeElement($magazineCategoryAssignment);
    }

    /**
     * Get magazineCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMagazineCategoryAssignments()
    {
        return $this->magazineCategoryAssignments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $menuEntryCategoryAssignments;


    /**
     * Add menuEntryCategoryAssignment
     *
     * @param \AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment
     *
     * @return Category
     */
    public function addMenuEntryCategoryAssignment(\AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment)
    {
        $this->menuEntryCategoryAssignments[] = $menuEntryCategoryAssignment;

        return $this;
    }

    /**
     * Remove menuEntryCategoryAssignment
     *
     * @param \AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment
     */
    public function removeMenuEntryCategoryAssignment(\AppBundle\Entity\MenuEntryCategoryAssignment $menuEntryCategoryAssignment)
    {
        $this->menuEntryCategoryAssignments->removeElement($menuEntryCategoryAssignment);
    }

    /**
     * Get menuEntryCategoryAssignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenuEntryCategoryAssignments()
    {
        return $this->menuEntryCategoryAssignments;
    }
    
    /**
     * @var integer
     */
    private $rootId;


    /**
     * Set rootId
     *
     * @param integer $rootId
     *
     * @return Category
     */
    public function setRootId($rootId)
    {
        $this->rootId = $rootId;

        return $this;
    }

    /**
     * Get rootId
     *
     * @return integer
     */
    public function getRootId()
    {
        return $this->rootId;
    }
    
    /**
     * @var boolean
     */
    private $benchmark;


    /**
     * Set benchmark
     *
     * @param boolean $benchmark
     *
     * @return Category
     */
    public function setBenchmark($benchmark)
    {
        $this->benchmark = $benchmark;

        return $this;
    }

    /**
     * Get benchmark
     *
     * @return boolean
     */
    public function getBenchmark()
    {
        return $this->benchmark;
    }
    /**
     * @var integer
     */
    private $benchmarkType;


    /**
     * Set benchmarkType
     *
     * @param integer $benchmarkType
     *
     * @return Category
     */
    public function setBenchmarkType($benchmarkType)
    {
        $this->benchmarkType = $benchmarkType;

        return $this;
    }

    /**
     * Get benchmarkType
     *
     * @return integer
     */
    public function getBenchmarkType()
    {
        return $this->benchmarkType;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $benchmarkFields;


    /**
     * Add benchmarkField
     *
     * @param \AppBundle\Entity\BenchmarkField $benchmarkField
     *
     * @return Category
     */
    public function addBenchmarkField(\AppBundle\Entity\BenchmarkField $benchmarkField)
    {
        $this->benchmarkFields[] = $benchmarkField;

        return $this;
    }

    /**
     * Remove benchmarkField
     *
     * @param \AppBundle\Entity\BenchmarkField $benchmarkField
     */
    public function removeBenchmarkField(\AppBundle\Entity\BenchmarkField $benchmarkField)
    {
        $this->benchmarkFields->removeElement($benchmarkField);
    }

    /**
     * Get benchmarkFields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBenchmarkFields()
    {
        return $this->benchmarkFields;
    }
}
