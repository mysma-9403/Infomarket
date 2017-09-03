<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\ImageTree;

class Category extends ImageTree {

	const WASHER = 11;

	const CENTRIFUGE = 12;

	const WASHER_CENTRIFUGE = 13;

	public function getUploadPath() {
		return 'uploads/categories';
	}

	public function getDefaultIMChildCategory() {
		foreach ($this->getChildren() as $child) {
			if ($child->getInfomarket())
				return $child;
		}
		
		return null;
	}

	public function getDefaultIPChildCategory() {
		foreach ($this->getChildren() as $child) {
			if ($child->getInfoprodukt())
				return $child;
		}
		
		return null;
	}

	public function getDisplayName() {
		$result = $this->getName();
		
		if ($this->subname) {
			$result .= ' ' . $this->subname;
		}
		
		return $result;
	}

	/**
	 *
	 * @var string
	 */
	private $subname;

	/**
	 *
	 * @var boolean
	 */
	private $infomarket;

	/**
	 *
	 * @var boolean
	 */
	private $infoprodukt;

	/**
	 *
	 * @var boolean
	 */
	private $featured;

	/**
	 *
	 * @var boolean
	 */
	private $preleaf;

	/**
	 *
	 * @var integer
	 */
	private $orderNumber;

	/**
	 *
	 * @var string
	 */
	private $slug;

	/**
	 *
	 * @var string
	 */
	private $icon;

	/**
	 *
	 * @var string
	 */
	private $featuredImage;

	/**
	 *
	 * @var string
	 */
	private $iconImage;

	/**
	 *
	 * @var string
	 */
	private $content;

	/**
	 *
	 * @var boolean
	 */
	private $benchmark;

	/**
	 *
	 * @var integer
	 */
	private $rootId;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $children;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $advertCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $articleCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $branchCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $brandCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $productCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $termCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $userCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $magazineCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $menuEntryCategoryAssignments;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $benchmarkFields;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $parent;

	/**
	 * Set subname
	 *
	 * @param string $subname        	
	 *
	 * @return Category
	 */
	public function setSubname($subname) {
		$this->subname = $subname;
		
		return $this;
	}

	/**
	 * Get subname
	 *
	 * @return string
	 */
	public function getSubname() {
		return $this->subname;
	}

	/**
	 * Set infomarket
	 *
	 * @param boolean $infomarket        	
	 *
	 * @return Category
	 */
	public function setInfomarket($infomarket) {
		$this->infomarket = $infomarket;
		
		return $this;
	}

	/**
	 * Get infomarket
	 *
	 * @return boolean
	 */
	public function getInfomarket() {
		return $this->infomarket;
	}

	/**
	 * Set infoprodukt
	 *
	 * @param boolean $infoprodukt        	
	 *
	 * @return Category
	 */
	public function setInfoprodukt($infoprodukt) {
		$this->infoprodukt = $infoprodukt;
		
		return $this;
	}

	/**
	 * Get infoprodukt
	 *
	 * @return boolean
	 */
	public function getInfoprodukt() {
		return $this->infoprodukt;
	}

	/**
	 * Set featured
	 *
	 * @param boolean $featured        	
	 *
	 * @return Category
	 */
	public function setFeatured($featured) {
		$this->featured = $featured;
		
		return $this;
	}

	/**
	 * Get featured
	 *
	 * @return boolean
	 */
	public function getFeatured() {
		return $this->featured;
	}

	/**
	 * Set preleaf
	 *
	 * @param boolean $preleaf        	
	 *
	 * @return Category
	 */
	public function setPreleaf($preleaf) {
		$this->preleaf = $preleaf;
		
		return $this;
	}

	/**
	 * Get preleaf
	 *
	 * @return boolean
	 */
	public function getPreleaf() {
		return $this->preleaf;
	}

	/**
	 * Set orderNumber
	 *
	 * @param integer $orderNumber        	
	 *
	 * @return Category
	 */
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
		
		return $this;
	}

	/**
	 * Get orderNumber
	 *
	 * @return integer
	 */
	public function getOrderNumber() {
		return $this->orderNumber;
	}

	/**
	 * Set slug
	 *
	 * @param string $slug        	
	 *
	 * @return Category
	 */
	public function setSlug($slug) {
		$this->slug = $slug;
		
		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * Set icon
	 *
	 * @param string $icon        	
	 *
	 * @return Category
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
		
		return $this;
	}

	/**
	 * Get icon
	 *
	 * @return string
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Set featuredImage
	 *
	 * @param string $featuredImage        	
	 *
	 * @return Category
	 */
	public function setFeaturedImage($featuredImage) {
		$this->featuredImage = $featuredImage;
		
		return $this;
	}

	/**
	 * Get featuredImage
	 *
	 * @return string
	 */
	public function getFeaturedImage() {
		return $this->featuredImage;
	}

	/**
	 * Set iconImage
	 *
	 * @param string $iconImage        	
	 *
	 * @return Category
	 */
	public function setIconImage($iconImage) {
		$this->iconImage = $iconImage;
		
		return $this;
	}

	/**
	 * Get iconImage
	 *
	 * @return string
	 */
	public function getIconImage() {
		return $this->iconImage;
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return Category
	 */
	public function setContent($content) {
		$this->content = $content;
		
		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set benchmark
	 *
	 * @param boolean $benchmark        	
	 *
	 * @return Category
	 */
	public function setBenchmark($benchmark) {
		$this->benchmark = $benchmark;
		
		return $this;
	}

	/**
	 * Get benchmark
	 *
	 * @return boolean
	 */
	public function getBenchmark() {
		return $this->benchmark;
	}

	/**
	 * Set rootId
	 *
	 * @param integer $rootId        	
	 *
	 * @return Category
	 */
	public function setRootId($rootId) {
		$this->rootId = $rootId;
		
		return $this;
	}

	/**
	 * Get rootId
	 *
	 * @return integer
	 */
	public function getRootId() {
		return $this->rootId;
	}

	/**
	 * Add child
	 *
	 * @param \AppBundle\Entity\Main\Category $child        	
	 *
	 * @return Category
	 */
	public function addChild(\AppBundle\Entity\Main\Category $child) {
		$this->children[] = $child;
		
		return $this;
	}

	/**
	 * Remove child
	 *
	 * @param \AppBundle\Entity\Main\Category $child        	
	 */
	public function removeChild(\AppBundle\Entity\Main\Category $child) {
		$this->children->removeElement($child);
	}

	/**
	 * Get children
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getChildren() {
		return $this->children;
	}

	/**
	 * Add advertCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addAdvertCategoryAssignment(
			\AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment) {
		$this->advertCategoryAssignments[] = $advertCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove advertCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment        	
	 */
	public function removeAdvertCategoryAssignment(
			\AppBundle\Entity\Assignments\AdvertCategoryAssignment $advertCategoryAssignment) {
		$this->advertCategoryAssignments->removeElement($advertCategoryAssignment);
	}

	/**
	 * Get advertCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getAdvertCategoryAssignments() {
		return $this->advertCategoryAssignments;
	}

	/**
	 * Add articleCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addArticleCategoryAssignment(
			\AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment) {
		$this->articleCategoryAssignments[] = $articleCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove articleCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment        	
	 */
	public function removeArticleCategoryAssignment(
			\AppBundle\Entity\Assignments\ArticleCategoryAssignment $articleCategoryAssignment) {
		$this->articleCategoryAssignments->removeElement($articleCategoryAssignment);
	}

	/**
	 * Get articleCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticleCategoryAssignments() {
		return $this->articleCategoryAssignments;
	}

	/**
	 * Add branchCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addBranchCategoryAssignment(
			\AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment) {
		$this->branchCategoryAssignments[] = $branchCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove branchCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment        	
	 */
	public function removeBranchCategoryAssignment(
			\AppBundle\Entity\Assignments\BranchCategoryAssignment $branchCategoryAssignment) {
		$this->branchCategoryAssignments->removeElement($branchCategoryAssignment);
	}

	/**
	 * Get branchCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBranchCategoryAssignments() {
		return $this->branchCategoryAssignments;
	}

	/**
	 * Add brandCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addBrandCategoryAssignment(
			\AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment) {
		$this->brandCategoryAssignments[] = $brandCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove brandCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment        	
	 */
	public function removeBrandCategoryAssignment(
			\AppBundle\Entity\Assignments\BrandCategoryAssignment $brandCategoryAssignment) {
		$this->brandCategoryAssignments->removeElement($brandCategoryAssignment);
	}

	/**
	 * Get brandCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBrandCategoryAssignments() {
		return $this->brandCategoryAssignments;
	}

	/**
	 * Add productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addProductCategoryAssignment(
			\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment) {
		$this->productCategoryAssignments[] = $productCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 */
	public function removeProductCategoryAssignment(
			\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment) {
		$this->productCategoryAssignments->removeElement($productCategoryAssignment);
	}

	/**
	 * Get productCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getProductCategoryAssignments() {
		return $this->productCategoryAssignments;
	}

	/**
	 * Add termCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addTermCategoryAssignment(
			\AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment) {
		$this->termCategoryAssignments[] = $termCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove termCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment        	
	 */
	public function removeTermCategoryAssignment(
			\AppBundle\Entity\Assignments\TermCategoryAssignment $termCategoryAssignment) {
		$this->termCategoryAssignments->removeElement($termCategoryAssignment);
	}

	/**
	 * Get termCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getTermCategoryAssignments() {
		return $this->termCategoryAssignments;
	}

	/**
	 * Add userCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addUserCategoryAssignment(
			\AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment) {
		$this->userCategoryAssignments[] = $userCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove userCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment        	
	 */
	public function removeUserCategoryAssignment(
			\AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment) {
		$this->userCategoryAssignments->removeElement($userCategoryAssignment);
	}

	/**
	 * Get userCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getUserCategoryAssignments() {
		return $this->userCategoryAssignments;
	}

	/**
	 * Add magazineCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addMagazineCategoryAssignment(
			\AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment) {
		$this->magazineCategoryAssignments[] = $magazineCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove magazineCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment        	
	 */
	public function removeMagazineCategoryAssignment(
			\AppBundle\Entity\Assignments\MagazineCategoryAssignment $magazineCategoryAssignment) {
		$this->magazineCategoryAssignments->removeElement($magazineCategoryAssignment);
	}

	/**
	 * Get magazineCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMagazineCategoryAssignments() {
		return $this->magazineCategoryAssignments;
	}

	/**
	 * Add menuEntryCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment        	
	 *
	 * @return Category
	 */
	public function addMenuEntryCategoryAssignment(
			\AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment) {
		$this->menuEntryCategoryAssignments[] = $menuEntryCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove menuEntryCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment        	
	 */
	public function removeMenuEntryCategoryAssignment(
			\AppBundle\Entity\Assignments\MenuEntryCategoryAssignment $menuEntryCategoryAssignment) {
		$this->menuEntryCategoryAssignments->removeElement($menuEntryCategoryAssignment);
	}

	/**
	 * Get menuEntryCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMenuEntryCategoryAssignments() {
		return $this->menuEntryCategoryAssignments;
	}

	/**
	 * Add benchmarkField
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkField $benchmarkField        	
	 *
	 * @return Category
	 */
	public function addBenchmarkField(\AppBundle\Entity\Main\BenchmarkField $benchmarkField) {
		$this->benchmarkFields[] = $benchmarkField;
		
		return $this;
	}

	/**
	 * Remove benchmarkField
	 *
	 * @param \AppBundle\Entity\Main\BenchmarkField $benchmarkField        	
	 */
	public function removeBenchmarkField(\AppBundle\Entity\Main\BenchmarkField $benchmarkField) {
		$this->benchmarkFields->removeElement($benchmarkField);
	}

	/**
	 * Get benchmarkFields
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getBenchmarkFields() {
		return $this->benchmarkFields;
	}

	/**
	 * Set parent
	 *
	 * @param \AppBundle\Entity\Main\Category $parent        	
	 *
	 * @return Category
	 */
	public function setParent(\AppBundle\Entity\Main\Category $parent = null) {
		$this->parent = $parent;
		
		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getParent() {
		return $this->parent;
	}
}
