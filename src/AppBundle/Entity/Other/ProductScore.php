<?php

namespace AppBundle\Entity\Other;

use AppBundle\Entity\Base\Simple;

/**
 * ProductScore
 */
class ProductScore extends Simple {

	public function offsetExists($offset) {
		if (strpos($offset, 'stringScore') !== false) {
			return true;
		}
		
		return false;
	}

	public function offsetGet($offset) {
		return $this->$offset;
	}

	public function offsetSet($offset, $value) {
		$this->$offset = $value;
		
		return $this;
	}

	public function offsetUnset($offset) {
		$this->$offset = null;
		
		return $this;
	}

	/**
	 *
	 * @var boolean
	 */
	private $upToDate;

	/**
	 *
	 * @var integer
	 */
	private $stringScore1;

	/**
	 *
	 * @var integer
	 */
	private $stringScore2;

	/**
	 *
	 * @var integer
	 */
	private $stringScore3;

	/**
	 *
	 * @var integer
	 */
	private $stringScore4;

	/**
	 *
	 * @var integer
	 */
	private $stringScore5;

	/**
	 *
	 * @var integer
	 */
	private $stringScore6;

	/**
	 *
	 * @var integer
	 */
	private $stringScore7;

	/**
	 *
	 * @var integer
	 */
	private $stringScore8;

	/**
	 *
	 * @var integer
	 */
	private $stringScore9;

	/**
	 *
	 * @var integer
	 */
	private $stringScore10;

	/**
	 *
	 * @var integer
	 */
	private $stringScore11;

	/**
	 *
	 * @var integer
	 */
	private $stringScore12;

	/**
	 *
	 * @var integer
	 */
	private $stringScore13;

	/**
	 *
	 * @var integer
	 */
	private $stringScore14;

	/**
	 *
	 * @var integer
	 */
	private $stringScore15;

	/**
	 *
	 * @var integer
	 */
	private $stringScore16;

	/**
	 *
	 * @var integer
	 */
	private $stringScore17;

	/**
	 *
	 * @var integer
	 */
	private $stringScore18;

	/**
	 *
	 * @var integer
	 */
	private $stringScore19;

	/**
	 *
	 * @var integer
	 */
	private $stringScore20;

	/**
	 *
	 * @var integer
	 */
	private $stringScore21;

	/**
	 *
	 * @var integer
	 */
	private $stringScore22;

	/**
	 *
	 * @var integer
	 */
	private $stringScore23;

	/**
	 *
	 * @var integer
	 */
	private $stringScore24;

	/**
	 *
	 * @var integer
	 */
	private $stringScore25;

	/**
	 *
	 * @var integer
	 */
	private $stringScore26;

	/**
	 *
	 * @var integer
	 */
	private $stringScore27;

	/**
	 *
	 * @var integer
	 */
	private $stringScore28;

	/**
	 *
	 * @var integer
	 */
	private $stringScore29;

	/**
	 *
	 * @var integer
	 */
	private $stringScore30;

	/**
	 *
	 * @var \AppBundle\Entity\Assignments\ProductCategoryAssignment
	 */
	private $productCategoryAssignment;

	/**
	 * Set upToDate
	 *
	 * @param boolean $upToDate        	
	 *
	 * @return ProductScore
	 */
	public function setUpToDate($upToDate) {
		$this->upToDate = $upToDate;
		
		return $this;
	}

	/**
	 * Get upToDate
	 *
	 * @return boolean
	 */
	public function getUpToDate() {
		return $this->upToDate;
	}

	/**
	 * Set stringScore1
	 *
	 * @param integer $stringScore1        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore1($stringScore1) {
		$this->stringScore1 = $stringScore1;
		
		return $this;
	}

	/**
	 * Get stringScore1
	 *
	 * @return integer
	 */
	public function getStringScore1() {
		return $this->stringScore1;
	}

	/**
	 * Set stringScore2
	 *
	 * @param integer $stringScore2        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore2($stringScore2) {
		$this->stringScore2 = $stringScore2;
		
		return $this;
	}

	/**
	 * Get stringScore2
	 *
	 * @return integer
	 */
	public function getStringScore2() {
		return $this->stringScore2;
	}

	/**
	 * Set stringScore3
	 *
	 * @param integer $stringScore3        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore3($stringScore3) {
		$this->stringScore3 = $stringScore3;
		
		return $this;
	}

	/**
	 * Get stringScore3
	 *
	 * @return integer
	 */
	public function getStringScore3() {
		return $this->stringScore3;
	}

	/**
	 * Set stringScore4
	 *
	 * @param integer $stringScore4        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore4($stringScore4) {
		$this->stringScore4 = $stringScore4;
		
		return $this;
	}

	/**
	 * Get stringScore4
	 *
	 * @return integer
	 */
	public function getStringScore4() {
		return $this->stringScore4;
	}

	/**
	 * Set stringScore5
	 *
	 * @param integer $stringScore5        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore5($stringScore5) {
		$this->stringScore5 = $stringScore5;
		
		return $this;
	}

	/**
	 * Get stringScore5
	 *
	 * @return integer
	 */
	public function getStringScore5() {
		return $this->stringScore5;
	}

	/**
	 * Set stringScore6
	 *
	 * @param integer $stringScore6        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore6($stringScore6) {
		$this->stringScore6 = $stringScore6;
		
		return $this;
	}

	/**
	 * Get stringScore6
	 *
	 * @return integer
	 */
	public function getStringScore6() {
		return $this->stringScore6;
	}

	/**
	 * Set stringScore7
	 *
	 * @param integer $stringScore7        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore7($stringScore7) {
		$this->stringScore7 = $stringScore7;
		
		return $this;
	}

	/**
	 * Get stringScore7
	 *
	 * @return integer
	 */
	public function getStringScore7() {
		return $this->stringScore7;
	}

	/**
	 * Set stringScore8
	 *
	 * @param integer $stringScore8        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore8($stringScore8) {
		$this->stringScore8 = $stringScore8;
		
		return $this;
	}

	/**
	 * Get stringScore8
	 *
	 * @return integer
	 */
	public function getStringScore8() {
		return $this->stringScore8;
	}

	/**
	 * Set stringScore9
	 *
	 * @param integer $stringScore9        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore9($stringScore9) {
		$this->stringScore9 = $stringScore9;
		
		return $this;
	}

	/**
	 * Get stringScore9
	 *
	 * @return integer
	 */
	public function getStringScore9() {
		return $this->stringScore9;
	}

	/**
	 * Set stringScore10
	 *
	 * @param integer $stringScore10        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore10($stringScore10) {
		$this->stringScore10 = $stringScore10;
		
		return $this;
	}

	/**
	 * Get stringScore10
	 *
	 * @return integer
	 */
	public function getStringScore10() {
		return $this->stringScore10;
	}

	/**
	 * Set stringScore11
	 *
	 * @param integer $stringScore11        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore11($stringScore11) {
		$this->stringScore11 = $stringScore11;
		
		return $this;
	}

	/**
	 * Get stringScore11
	 *
	 * @return integer
	 */
	public function getStringScore11() {
		return $this->stringScore11;
	}

	/**
	 * Set stringScore12
	 *
	 * @param integer $stringScore12        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore12($stringScore12) {
		$this->stringScore12 = $stringScore12;
		
		return $this;
	}

	/**
	 * Get stringScore12
	 *
	 * @return integer
	 */
	public function getStringScore12() {
		return $this->stringScore12;
	}

	/**
	 * Set stringScore13
	 *
	 * @param integer $stringScore13        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore13($stringScore13) {
		$this->stringScore13 = $stringScore13;
		
		return $this;
	}

	/**
	 * Get stringScore13
	 *
	 * @return integer
	 */
	public function getStringScore13() {
		return $this->stringScore13;
	}

	/**
	 * Set stringScore14
	 *
	 * @param integer $stringScore14        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore14($stringScore14) {
		$this->stringScore14 = $stringScore14;
		
		return $this;
	}

	/**
	 * Get stringScore14
	 *
	 * @return integer
	 */
	public function getStringScore14() {
		return $this->stringScore14;
	}

	/**
	 * Set stringScore15
	 *
	 * @param integer $stringScore15        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore15($stringScore15) {
		$this->stringScore15 = $stringScore15;
		
		return $this;
	}

	/**
	 * Get stringScore15
	 *
	 * @return integer
	 */
	public function getStringScore15() {
		return $this->stringScore15;
	}

	/**
	 * Set stringScore16
	 *
	 * @param integer $stringScore16        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore16($stringScore16) {
		$this->stringScore16 = $stringScore16;
		
		return $this;
	}

	/**
	 * Get stringScore16
	 *
	 * @return integer
	 */
	public function getStringScore16() {
		return $this->stringScore16;
	}

	/**
	 * Set stringScore17
	 *
	 * @param integer $stringScore17        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore17($stringScore17) {
		$this->stringScore17 = $stringScore17;
		
		return $this;
	}

	/**
	 * Get stringScore17
	 *
	 * @return integer
	 */
	public function getStringScore17() {
		return $this->stringScore17;
	}

	/**
	 * Set stringScore18
	 *
	 * @param integer $stringScore18        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore18($stringScore18) {
		$this->stringScore18 = $stringScore18;
		
		return $this;
	}

	/**
	 * Get stringScore18
	 *
	 * @return integer
	 */
	public function getStringScore18() {
		return $this->stringScore18;
	}

	/**
	 * Set stringScore19
	 *
	 * @param integer $stringScore19        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore19($stringScore19) {
		$this->stringScore19 = $stringScore19;
		
		return $this;
	}

	/**
	 * Get stringScore19
	 *
	 * @return integer
	 */
	public function getStringScore19() {
		return $this->stringScore19;
	}

	/**
	 * Set stringScore20
	 *
	 * @param integer $stringScore20        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore20($stringScore20) {
		$this->stringScore20 = $stringScore20;
		
		return $this;
	}

	/**
	 * Get stringScore20
	 *
	 * @return integer
	 */
	public function getStringScore20() {
		return $this->stringScore20;
	}

	/**
	 * Set stringScore21
	 *
	 * @param integer $stringScore21        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore21($stringScore21) {
		$this->stringScore21 = $stringScore21;
		
		return $this;
	}

	/**
	 * Get stringScore21
	 *
	 * @return integer
	 */
	public function getStringScore21() {
		return $this->stringScore21;
	}

	/**
	 * Set stringScore22
	 *
	 * @param integer $stringScore22        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore22($stringScore22) {
		$this->stringScore22 = $stringScore22;
		
		return $this;
	}

	/**
	 * Get stringScore22
	 *
	 * @return integer
	 */
	public function getStringScore22() {
		return $this->stringScore22;
	}

	/**
	 * Set stringScore23
	 *
	 * @param integer $stringScore23        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore23($stringScore23) {
		$this->stringScore23 = $stringScore23;
		
		return $this;
	}

	/**
	 * Get stringScore23
	 *
	 * @return integer
	 */
	public function getStringScore23() {
		return $this->stringScore23;
	}

	/**
	 * Set stringScore24
	 *
	 * @param integer $stringScore24        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore24($stringScore24) {
		$this->stringScore24 = $stringScore24;
		
		return $this;
	}

	/**
	 * Get stringScore24
	 *
	 * @return integer
	 */
	public function getStringScore24() {
		return $this->stringScore24;
	}

	/**
	 * Set stringScore25
	 *
	 * @param integer $stringScore25        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore25($stringScore25) {
		$this->stringScore25 = $stringScore25;
		
		return $this;
	}

	/**
	 * Get stringScore25
	 *
	 * @return integer
	 */
	public function getStringScore25() {
		return $this->stringScore25;
	}

	/**
	 * Set stringScore26
	 *
	 * @param integer $stringScore26        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore26($stringScore26) {
		$this->stringScore26 = $stringScore26;
		
		return $this;
	}

	/**
	 * Get stringScore26
	 *
	 * @return integer
	 */
	public function getStringScore26() {
		return $this->stringScore26;
	}

	/**
	 * Set stringScore27
	 *
	 * @param integer $stringScore27        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore27($stringScore27) {
		$this->stringScore27 = $stringScore27;
		
		return $this;
	}

	/**
	 * Get stringScore27
	 *
	 * @return integer
	 */
	public function getStringScore27() {
		return $this->stringScore27;
	}

	/**
	 * Set stringScore28
	 *
	 * @param integer $stringScore28        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore28($stringScore28) {
		$this->stringScore28 = $stringScore28;
		
		return $this;
	}

	/**
	 * Get stringScore28
	 *
	 * @return integer
	 */
	public function getStringScore28() {
		return $this->stringScore28;
	}

	/**
	 * Set stringScore29
	 *
	 * @param integer $stringScore29        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore29($stringScore29) {
		$this->stringScore29 = $stringScore29;
		
		return $this;
	}

	/**
	 * Get stringScore29
	 *
	 * @return integer
	 */
	public function getStringScore29() {
		return $this->stringScore29;
	}

	/**
	 * Set stringScore30
	 *
	 * @param integer $stringScore30        	
	 *
	 * @return ProductScore
	 */
	public function setStringScore30($stringScore30) {
		$this->stringScore30 = $stringScore30;
		
		return $this;
	}

	/**
	 * Get stringScore30
	 *
	 * @return integer
	 */
	public function getStringScore30() {
		return $this->stringScore30;
	}

	/**
	 * Set productCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment        	
	 *
	 * @return ProductScore
	 */
	public function setProductCategoryAssignment(
			\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment = null) {
		$this->productCategoryAssignment = $productCategoryAssignment;
		
		return $this;
	}

	/**
	 * Get productCategoryAssignment
	 *
	 * @return \AppBundle\Entity\Assignments\ProductCategoryAssignment
	 */
	public function getProductCategoryAssignment() {
		return $this->productCategoryAssignment;
	}
}
