<?php

namespace AppBundle\Entity\Other;

class CategoryDistribution {

	public function offsetExists($offset) {
		if (strpos($offset, 'decimalDistribution') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMean') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMode') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMedian') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerDistribution') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMean') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMode') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMedian') !== false) {
			return true;
		}
		
		if (strpos($offset, 'stringDistribution') !== false) {
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
	 * @var integer
	 */
	private $id;

	/**
	 *
	 * @var \AppBundle\Entity\Main\Category
	 */
	private $category;

	/**
	 *
	 * @var boolean
	 */
	private $upToDate;

	/**
	 *
	 * @var string
	 */
	private $decimalDistribution1;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution2;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution3;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution4;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution5;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution6;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution7;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution8;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution9;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution10;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution11;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution12;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution13;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution14;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution15;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution16;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution17;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution18;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution19;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution20;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution21;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution22;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution23;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution24;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution25;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution26;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution27;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution28;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution29;
	
	/**
	 *
	 * @var string
	 */
	private $decimalDistribution30;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMean1;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean2;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean3;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean4;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean5;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean6;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean7;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean8;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean9;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean10;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean11;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean12;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean13;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean14;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean15;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean16;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean17;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean18;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean19;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean20;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean21;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean22;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean23;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean24;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean25;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean26;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean27;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean28;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean29;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMean30;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode1;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode2;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode3;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode4;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode5;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode6;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode7;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode8;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode9;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode10;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode11;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode12;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode13;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode14;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode15;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode16;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode17;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode18;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode19;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode20;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode21;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode22;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode23;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode24;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode25;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode26;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode27;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode28;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode29;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMode30;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian1;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian2;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian3;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian4;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian5;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian6;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian7;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian8;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian9;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian10;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian11;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian12;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian13;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian14;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian15;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian16;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian17;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian18;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian19;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian20;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian21;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian22;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian23;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian24;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian25;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian26;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian27;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian28;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian29;
	
	/**
	 *
	 * @var decimal
	 */
	private $decimalMedian30;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution1;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution2;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution3;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution4;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution5;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution6;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution7;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution8;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution9;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution10;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution11;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution12;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution13;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution14;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution15;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution16;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution17;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution18;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution19;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution20;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution21;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution22;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution23;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution24;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution25;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution26;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution27;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution28;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution29;
	
	/**
	 *
	 * @var string
	 */
	private $integerDistribution30;
	
	/**
	 *
	 * @var decimal
	 */
	private $integerMean1;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean2;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean3;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean4;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean5;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean6;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean7;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean8;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean9;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean10;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean11;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean12;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean13;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean14;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean15;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean16;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean17;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean18;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean19;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean20;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean21;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean22;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean23;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean24;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean25;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean26;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean27;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean28;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean29;

	/**
	 *
	 * @var decimal
	 */
	private $integerMean30;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode1;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode2;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode3;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode4;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode5;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode6;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode7;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode8;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode9;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode10;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode11;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode12;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode13;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode14;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode15;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode16;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode17;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode18;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode19;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode20;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode21;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode22;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode23;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode24;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode25;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode26;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode27;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode28;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode29;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMode30;

	/**
	 *
	 * @var integer
	 */
	private $integerMedian1;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian2;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian3;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian4;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian5;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian6;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian7;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian8;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian9;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian10;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian11;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian12;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian13;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian14;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian15;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian16;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian17;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian18;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian19;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian20;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian21;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian22;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian23;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian24;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian25;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian26;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian27;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian28;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian29;
	
	/**
	 *
	 * @var integer
	 */
	private $integerMedian30;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution1;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution2;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution3;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution4;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution5;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution6;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution7;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution8;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution9;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution10;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution11;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution12;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution13;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution14;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution15;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution16;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution17;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution18;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution19;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution20;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution21;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution22;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution23;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution24;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution25;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution26;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution27;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution28;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution29;
	
	/**
	 *
	 * @var string
	 */
	private $stringDistribution30;

    /**
     * Set upToDate
     *
     * @param boolean $upToDate
     *
     * @return CategoryDistribution
     */
    public function setUpToDate($upToDate)
    {
        $this->upToDate = $upToDate;

        return $this;
    }

    /**
     * Get upToDate
     *
     * @return boolean
     */
    public function getUpToDate()
    {
        return $this->upToDate;
    }

    /**
     * Set decimalDistribution1
     *
     * @param string $decimalDistribution1
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution1($decimalDistribution1)
    {
        $this->decimalDistribution1 = $decimalDistribution1;

        return $this;
    }

    /**
     * Get decimalDistribution1
     *
     * @return string
     */
    public function getDecimalDistribution1()
    {
        return $this->decimalDistribution1;
    }

    /**
     * Set decimalDistribution2
     *
     * @param string $decimalDistribution2
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution2($decimalDistribution2)
    {
        $this->decimalDistribution2 = $decimalDistribution2;

        return $this;
    }

    /**
     * Get decimalDistribution2
     *
     * @return string
     */
    public function getDecimalDistribution2()
    {
        return $this->decimalDistribution2;
    }

    /**
     * Set decimalDistribution3
     *
     * @param string $decimalDistribution3
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution3($decimalDistribution3)
    {
        $this->decimalDistribution3 = $decimalDistribution3;

        return $this;
    }

    /**
     * Get decimalDistribution3
     *
     * @return string
     */
    public function getDecimalDistribution3()
    {
        return $this->decimalDistribution3;
    }

    /**
     * Set decimalDistribution4
     *
     * @param string $decimalDistribution4
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution4($decimalDistribution4)
    {
        $this->decimalDistribution4 = $decimalDistribution4;

        return $this;
    }

    /**
     * Get decimalDistribution4
     *
     * @return string
     */
    public function getDecimalDistribution4()
    {
        return $this->decimalDistribution4;
    }

    /**
     * Set decimalDistribution5
     *
     * @param string $decimalDistribution5
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution5($decimalDistribution5)
    {
        $this->decimalDistribution5 = $decimalDistribution5;

        return $this;
    }

    /**
     * Get decimalDistribution5
     *
     * @return string
     */
    public function getDecimalDistribution5()
    {
        return $this->decimalDistribution5;
    }

    /**
     * Set decimalDistribution6
     *
     * @param string $decimalDistribution6
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution6($decimalDistribution6)
    {
        $this->decimalDistribution6 = $decimalDistribution6;

        return $this;
    }

    /**
     * Get decimalDistribution6
     *
     * @return string
     */
    public function getDecimalDistribution6()
    {
        return $this->decimalDistribution6;
    }

    /**
     * Set decimalDistribution7
     *
     * @param string $decimalDistribution7
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution7($decimalDistribution7)
    {
        $this->decimalDistribution7 = $decimalDistribution7;

        return $this;
    }

    /**
     * Get decimalDistribution7
     *
     * @return string
     */
    public function getDecimalDistribution7()
    {
        return $this->decimalDistribution7;
    }

    /**
     * Set decimalDistribution8
     *
     * @param string $decimalDistribution8
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution8($decimalDistribution8)
    {
        $this->decimalDistribution8 = $decimalDistribution8;

        return $this;
    }

    /**
     * Get decimalDistribution8
     *
     * @return string
     */
    public function getDecimalDistribution8()
    {
        return $this->decimalDistribution8;
    }

    /**
     * Set decimalDistribution9
     *
     * @param string $decimalDistribution9
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution9($decimalDistribution9)
    {
        $this->decimalDistribution9 = $decimalDistribution9;

        return $this;
    }

    /**
     * Get decimalDistribution9
     *
     * @return string
     */
    public function getDecimalDistribution9()
    {
        return $this->decimalDistribution9;
    }

    /**
     * Set decimalDistribution10
     *
     * @param string $decimalDistribution10
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution10($decimalDistribution10)
    {
        $this->decimalDistribution10 = $decimalDistribution10;

        return $this;
    }

    /**
     * Get decimalDistribution10
     *
     * @return string
     */
    public function getDecimalDistribution10()
    {
        return $this->decimalDistribution10;
    }

    /**
     * Set decimalDistribution11
     *
     * @param string $decimalDistribution11
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution11($decimalDistribution11)
    {
        $this->decimalDistribution11 = $decimalDistribution11;

        return $this;
    }

    /**
     * Get decimalDistribution11
     *
     * @return string
     */
    public function getDecimalDistribution11()
    {
        return $this->decimalDistribution11;
    }

    /**
     * Set decimalDistribution12
     *
     * @param string $decimalDistribution12
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution12($decimalDistribution12)
    {
        $this->decimalDistribution12 = $decimalDistribution12;

        return $this;
    }

    /**
     * Get decimalDistribution12
     *
     * @return string
     */
    public function getDecimalDistribution12()
    {
        return $this->decimalDistribution12;
    }

    /**
     * Set decimalDistribution13
     *
     * @param string $decimalDistribution13
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution13($decimalDistribution13)
    {
        $this->decimalDistribution13 = $decimalDistribution13;

        return $this;
    }

    /**
     * Get decimalDistribution13
     *
     * @return string
     */
    public function getDecimalDistribution13()
    {
        return $this->decimalDistribution13;
    }

    /**
     * Set decimalDistribution14
     *
     * @param string $decimalDistribution14
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution14($decimalDistribution14)
    {
        $this->decimalDistribution14 = $decimalDistribution14;

        return $this;
    }

    /**
     * Get decimalDistribution14
     *
     * @return string
     */
    public function getDecimalDistribution14()
    {
        return $this->decimalDistribution14;
    }

    /**
     * Set decimalDistribution15
     *
     * @param string $decimalDistribution15
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution15($decimalDistribution15)
    {
        $this->decimalDistribution15 = $decimalDistribution15;

        return $this;
    }

    /**
     * Get decimalDistribution15
     *
     * @return string
     */
    public function getDecimalDistribution15()
    {
        return $this->decimalDistribution15;
    }

    /**
     * Set decimalDistribution16
     *
     * @param string $decimalDistribution16
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution16($decimalDistribution16)
    {
        $this->decimalDistribution16 = $decimalDistribution16;

        return $this;
    }

    /**
     * Get decimalDistribution16
     *
     * @return string
     */
    public function getDecimalDistribution16()
    {
        return $this->decimalDistribution16;
    }

    /**
     * Set decimalDistribution17
     *
     * @param string $decimalDistribution17
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution17($decimalDistribution17)
    {
        $this->decimalDistribution17 = $decimalDistribution17;

        return $this;
    }

    /**
     * Get decimalDistribution17
     *
     * @return string
     */
    public function getDecimalDistribution17()
    {
        return $this->decimalDistribution17;
    }

    /**
     * Set decimalDistribution18
     *
     * @param string $decimalDistribution18
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution18($decimalDistribution18)
    {
        $this->decimalDistribution18 = $decimalDistribution18;

        return $this;
    }

    /**
     * Get decimalDistribution18
     *
     * @return string
     */
    public function getDecimalDistribution18()
    {
        return $this->decimalDistribution18;
    }

    /**
     * Set decimalDistribution19
     *
     * @param string $decimalDistribution19
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution19($decimalDistribution19)
    {
        $this->decimalDistribution19 = $decimalDistribution19;

        return $this;
    }

    /**
     * Get decimalDistribution19
     *
     * @return string
     */
    public function getDecimalDistribution19()
    {
        return $this->decimalDistribution19;
    }

    /**
     * Set decimalDistribution20
     *
     * @param string $decimalDistribution20
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution20($decimalDistribution20)
    {
        $this->decimalDistribution20 = $decimalDistribution20;

        return $this;
    }

    /**
     * Get decimalDistribution20
     *
     * @return string
     */
    public function getDecimalDistribution20()
    {
        return $this->decimalDistribution20;
    }

    /**
     * Set decimalDistribution21
     *
     * @param string $decimalDistribution21
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution21($decimalDistribution21)
    {
        $this->decimalDistribution21 = $decimalDistribution21;

        return $this;
    }

    /**
     * Get decimalDistribution21
     *
     * @return string
     */
    public function getDecimalDistribution21()
    {
        return $this->decimalDistribution21;
    }

    /**
     * Set decimalDistribution22
     *
     * @param string $decimalDistribution22
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution22($decimalDistribution22)
    {
        $this->decimalDistribution22 = $decimalDistribution22;

        return $this;
    }

    /**
     * Get decimalDistribution22
     *
     * @return string
     */
    public function getDecimalDistribution22()
    {
        return $this->decimalDistribution22;
    }

    /**
     * Set decimalDistribution23
     *
     * @param string $decimalDistribution23
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution23($decimalDistribution23)
    {
        $this->decimalDistribution23 = $decimalDistribution23;

        return $this;
    }

    /**
     * Get decimalDistribution23
     *
     * @return string
     */
    public function getDecimalDistribution23()
    {
        return $this->decimalDistribution23;
    }

    /**
     * Set decimalDistribution24
     *
     * @param string $decimalDistribution24
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution24($decimalDistribution24)
    {
        $this->decimalDistribution24 = $decimalDistribution24;

        return $this;
    }

    /**
     * Get decimalDistribution24
     *
     * @return string
     */
    public function getDecimalDistribution24()
    {
        return $this->decimalDistribution24;
    }

    /**
     * Set decimalDistribution25
     *
     * @param string $decimalDistribution25
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution25($decimalDistribution25)
    {
        $this->decimalDistribution25 = $decimalDistribution25;

        return $this;
    }

    /**
     * Get decimalDistribution25
     *
     * @return string
     */
    public function getDecimalDistribution25()
    {
        return $this->decimalDistribution25;
    }

    /**
     * Set decimalDistribution26
     *
     * @param string $decimalDistribution26
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution26($decimalDistribution26)
    {
        $this->decimalDistribution26 = $decimalDistribution26;

        return $this;
    }

    /**
     * Get decimalDistribution26
     *
     * @return string
     */
    public function getDecimalDistribution26()
    {
        return $this->decimalDistribution26;
    }

    /**
     * Set decimalDistribution27
     *
     * @param string $decimalDistribution27
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution27($decimalDistribution27)
    {
        $this->decimalDistribution27 = $decimalDistribution27;

        return $this;
    }

    /**
     * Get decimalDistribution27
     *
     * @return string
     */
    public function getDecimalDistribution27()
    {
        return $this->decimalDistribution27;
    }

    /**
     * Set decimalDistribution28
     *
     * @param string $decimalDistribution28
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution28($decimalDistribution28)
    {
        $this->decimalDistribution28 = $decimalDistribution28;

        return $this;
    }

    /**
     * Get decimalDistribution28
     *
     * @return string
     */
    public function getDecimalDistribution28()
    {
        return $this->decimalDistribution28;
    }

    /**
     * Set decimalDistribution29
     *
     * @param string $decimalDistribution29
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution29($decimalDistribution29)
    {
        $this->decimalDistribution29 = $decimalDistribution29;

        return $this;
    }

    /**
     * Get decimalDistribution29
     *
     * @return string
     */
    public function getDecimalDistribution29()
    {
        return $this->decimalDistribution29;
    }

    /**
     * Set decimalDistribution30
     *
     * @param string $decimalDistribution30
     *
     * @return CategoryDistribution
     */
    public function setDecimalDistribution30($decimalDistribution30)
    {
        $this->decimalDistribution30 = $decimalDistribution30;

        return $this;
    }

    /**
     * Get decimalDistribution30
     *
     * @return string
     */
    public function getDecimalDistribution30()
    {
        return $this->decimalDistribution30;
    }

    /**
     * Set decimalMean1
     *
     * @param string $decimalMean1
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean1($decimalMean1)
    {
        $this->decimalMean1 = $decimalMean1;

        return $this;
    }

    /**
     * Get decimalMean1
     *
     * @return string
     */
    public function getDecimalMean1()
    {
        return $this->decimalMean1;
    }

    /**
     * Set decimalMean2
     *
     * @param string $decimalMean2
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean2($decimalMean2)
    {
        $this->decimalMean2 = $decimalMean2;

        return $this;
    }

    /**
     * Get decimalMean2
     *
     * @return string
     */
    public function getDecimalMean2()
    {
        return $this->decimalMean2;
    }

    /**
     * Set decimalMean3
     *
     * @param string $decimalMean3
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean3($decimalMean3)
    {
        $this->decimalMean3 = $decimalMean3;

        return $this;
    }

    /**
     * Get decimalMean3
     *
     * @return string
     */
    public function getDecimalMean3()
    {
        return $this->decimalMean3;
    }

    /**
     * Set decimalMean4
     *
     * @param string $decimalMean4
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean4($decimalMean4)
    {
        $this->decimalMean4 = $decimalMean4;

        return $this;
    }

    /**
     * Get decimalMean4
     *
     * @return string
     */
    public function getDecimalMean4()
    {
        return $this->decimalMean4;
    }

    /**
     * Set decimalMean5
     *
     * @param string $decimalMean5
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean5($decimalMean5)
    {
        $this->decimalMean5 = $decimalMean5;

        return $this;
    }

    /**
     * Get decimalMean5
     *
     * @return string
     */
    public function getDecimalMean5()
    {
        return $this->decimalMean5;
    }

    /**
     * Set decimalMean6
     *
     * @param string $decimalMean6
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean6($decimalMean6)
    {
        $this->decimalMean6 = $decimalMean6;

        return $this;
    }

    /**
     * Get decimalMean6
     *
     * @return string
     */
    public function getDecimalMean6()
    {
        return $this->decimalMean6;
    }

    /**
     * Set decimalMean7
     *
     * @param string $decimalMean7
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean7($decimalMean7)
    {
        $this->decimalMean7 = $decimalMean7;

        return $this;
    }

    /**
     * Get decimalMean7
     *
     * @return string
     */
    public function getDecimalMean7()
    {
        return $this->decimalMean7;
    }

    /**
     * Set decimalMean8
     *
     * @param string $decimalMean8
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean8($decimalMean8)
    {
        $this->decimalMean8 = $decimalMean8;

        return $this;
    }

    /**
     * Get decimalMean8
     *
     * @return string
     */
    public function getDecimalMean8()
    {
        return $this->decimalMean8;
    }

    /**
     * Set decimalMean9
     *
     * @param string $decimalMean9
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean9($decimalMean9)
    {
        $this->decimalMean9 = $decimalMean9;

        return $this;
    }

    /**
     * Get decimalMean9
     *
     * @return string
     */
    public function getDecimalMean9()
    {
        return $this->decimalMean9;
    }

    /**
     * Set decimalMean10
     *
     * @param string $decimalMean10
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean10($decimalMean10)
    {
        $this->decimalMean10 = $decimalMean10;

        return $this;
    }

    /**
     * Get decimalMean10
     *
     * @return string
     */
    public function getDecimalMean10()
    {
        return $this->decimalMean10;
    }

    /**
     * Set decimalMean11
     *
     * @param string $decimalMean11
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean11($decimalMean11)
    {
        $this->decimalMean11 = $decimalMean11;

        return $this;
    }

    /**
     * Get decimalMean11
     *
     * @return string
     */
    public function getDecimalMean11()
    {
        return $this->decimalMean11;
    }

    /**
     * Set decimalMean12
     *
     * @param string $decimalMean12
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean12($decimalMean12)
    {
        $this->decimalMean12 = $decimalMean12;

        return $this;
    }

    /**
     * Get decimalMean12
     *
     * @return string
     */
    public function getDecimalMean12()
    {
        return $this->decimalMean12;
    }

    /**
     * Set decimalMean13
     *
     * @param string $decimalMean13
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean13($decimalMean13)
    {
        $this->decimalMean13 = $decimalMean13;

        return $this;
    }

    /**
     * Get decimalMean13
     *
     * @return string
     */
    public function getDecimalMean13()
    {
        return $this->decimalMean13;
    }

    /**
     * Set decimalMean14
     *
     * @param string $decimalMean14
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean14($decimalMean14)
    {
        $this->decimalMean14 = $decimalMean14;

        return $this;
    }

    /**
     * Get decimalMean14
     *
     * @return string
     */
    public function getDecimalMean14()
    {
        return $this->decimalMean14;
    }

    /**
     * Set decimalMean15
     *
     * @param string $decimalMean15
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean15($decimalMean15)
    {
        $this->decimalMean15 = $decimalMean15;

        return $this;
    }

    /**
     * Get decimalMean15
     *
     * @return string
     */
    public function getDecimalMean15()
    {
        return $this->decimalMean15;
    }

    /**
     * Set decimalMean16
     *
     * @param string $decimalMean16
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean16($decimalMean16)
    {
        $this->decimalMean16 = $decimalMean16;

        return $this;
    }

    /**
     * Get decimalMean16
     *
     * @return string
     */
    public function getDecimalMean16()
    {
        return $this->decimalMean16;
    }

    /**
     * Set decimalMean17
     *
     * @param string $decimalMean17
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean17($decimalMean17)
    {
        $this->decimalMean17 = $decimalMean17;

        return $this;
    }

    /**
     * Get decimalMean17
     *
     * @return string
     */
    public function getDecimalMean17()
    {
        return $this->decimalMean17;
    }

    /**
     * Set decimalMean18
     *
     * @param string $decimalMean18
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean18($decimalMean18)
    {
        $this->decimalMean18 = $decimalMean18;

        return $this;
    }

    /**
     * Get decimalMean18
     *
     * @return string
     */
    public function getDecimalMean18()
    {
        return $this->decimalMean18;
    }

    /**
     * Set decimalMean19
     *
     * @param string $decimalMean19
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean19($decimalMean19)
    {
        $this->decimalMean19 = $decimalMean19;

        return $this;
    }

    /**
     * Get decimalMean19
     *
     * @return string
     */
    public function getDecimalMean19()
    {
        return $this->decimalMean19;
    }

    /**
     * Set decimalMean20
     *
     * @param string $decimalMean20
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean20($decimalMean20)
    {
        $this->decimalMean20 = $decimalMean20;

        return $this;
    }

    /**
     * Get decimalMean20
     *
     * @return string
     */
    public function getDecimalMean20()
    {
        return $this->decimalMean20;
    }

    /**
     * Set decimalMean21
     *
     * @param string $decimalMean21
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean21($decimalMean21)
    {
        $this->decimalMean21 = $decimalMean21;

        return $this;
    }

    /**
     * Get decimalMean21
     *
     * @return string
     */
    public function getDecimalMean21()
    {
        return $this->decimalMean21;
    }

    /**
     * Set decimalMean22
     *
     * @param string $decimalMean22
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean22($decimalMean22)
    {
        $this->decimalMean22 = $decimalMean22;

        return $this;
    }

    /**
     * Get decimalMean22
     *
     * @return string
     */
    public function getDecimalMean22()
    {
        return $this->decimalMean22;
    }

    /**
     * Set decimalMean23
     *
     * @param string $decimalMean23
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean23($decimalMean23)
    {
        $this->decimalMean23 = $decimalMean23;

        return $this;
    }

    /**
     * Get decimalMean23
     *
     * @return string
     */
    public function getDecimalMean23()
    {
        return $this->decimalMean23;
    }

    /**
     * Set decimalMean24
     *
     * @param string $decimalMean24
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean24($decimalMean24)
    {
        $this->decimalMean24 = $decimalMean24;

        return $this;
    }

    /**
     * Get decimalMean24
     *
     * @return string
     */
    public function getDecimalMean24()
    {
        return $this->decimalMean24;
    }

    /**
     * Set decimalMean25
     *
     * @param string $decimalMean25
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean25($decimalMean25)
    {
        $this->decimalMean25 = $decimalMean25;

        return $this;
    }

    /**
     * Get decimalMean25
     *
     * @return string
     */
    public function getDecimalMean25()
    {
        return $this->decimalMean25;
    }

    /**
     * Set decimalMean26
     *
     * @param string $decimalMean26
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean26($decimalMean26)
    {
        $this->decimalMean26 = $decimalMean26;

        return $this;
    }

    /**
     * Get decimalMean26
     *
     * @return string
     */
    public function getDecimalMean26()
    {
        return $this->decimalMean26;
    }

    /**
     * Set decimalMean27
     *
     * @param string $decimalMean27
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean27($decimalMean27)
    {
        $this->decimalMean27 = $decimalMean27;

        return $this;
    }

    /**
     * Get decimalMean27
     *
     * @return string
     */
    public function getDecimalMean27()
    {
        return $this->decimalMean27;
    }

    /**
     * Set decimalMean28
     *
     * @param string $decimalMean28
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean28($decimalMean28)
    {
        $this->decimalMean28 = $decimalMean28;

        return $this;
    }

    /**
     * Get decimalMean28
     *
     * @return string
     */
    public function getDecimalMean28()
    {
        return $this->decimalMean28;
    }

    /**
     * Set decimalMean29
     *
     * @param string $decimalMean29
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean29($decimalMean29)
    {
        $this->decimalMean29 = $decimalMean29;

        return $this;
    }

    /**
     * Get decimalMean29
     *
     * @return string
     */
    public function getDecimalMean29()
    {
        return $this->decimalMean29;
    }

    /**
     * Set decimalMean30
     *
     * @param string $decimalMean30
     *
     * @return CategoryDistribution
     */
    public function setDecimalMean30($decimalMean30)
    {
        $this->decimalMean30 = $decimalMean30;

        return $this;
    }

    /**
     * Get decimalMean30
     *
     * @return string
     */
    public function getDecimalMean30()
    {
        return $this->decimalMean30;
    }

    /**
     * Set decimalMode1
     *
     * @param string $decimalMode1
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode1($decimalMode1)
    {
        $this->decimalMode1 = $decimalMode1;

        return $this;
    }

    /**
     * Get decimalMode1
     *
     * @return string
     */
    public function getDecimalMode1()
    {
        return $this->decimalMode1;
    }

    /**
     * Set decimalMode2
     *
     * @param string $decimalMode2
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode2($decimalMode2)
    {
        $this->decimalMode2 = $decimalMode2;

        return $this;
    }

    /**
     * Get decimalMode2
     *
     * @return string
     */
    public function getDecimalMode2()
    {
        return $this->decimalMode2;
    }

    /**
     * Set decimalMode3
     *
     * @param string $decimalMode3
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode3($decimalMode3)
    {
        $this->decimalMode3 = $decimalMode3;

        return $this;
    }

    /**
     * Get decimalMode3
     *
     * @return string
     */
    public function getDecimalMode3()
    {
        return $this->decimalMode3;
    }

    /**
     * Set decimalMode4
     *
     * @param string $decimalMode4
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode4($decimalMode4)
    {
        $this->decimalMode4 = $decimalMode4;

        return $this;
    }

    /**
     * Get decimalMode4
     *
     * @return string
     */
    public function getDecimalMode4()
    {
        return $this->decimalMode4;
    }

    /**
     * Set decimalMode5
     *
     * @param string $decimalMode5
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode5($decimalMode5)
    {
        $this->decimalMode5 = $decimalMode5;

        return $this;
    }

    /**
     * Get decimalMode5
     *
     * @return string
     */
    public function getDecimalMode5()
    {
        return $this->decimalMode5;
    }

    /**
     * Set decimalMode6
     *
     * @param string $decimalMode6
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode6($decimalMode6)
    {
        $this->decimalMode6 = $decimalMode6;

        return $this;
    }

    /**
     * Get decimalMode6
     *
     * @return string
     */
    public function getDecimalMode6()
    {
        return $this->decimalMode6;
    }

    /**
     * Set decimalMode7
     *
     * @param string $decimalMode7
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode7($decimalMode7)
    {
        $this->decimalMode7 = $decimalMode7;

        return $this;
    }

    /**
     * Get decimalMode7
     *
     * @return string
     */
    public function getDecimalMode7()
    {
        return $this->decimalMode7;
    }

    /**
     * Set decimalMode8
     *
     * @param string $decimalMode8
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode8($decimalMode8)
    {
        $this->decimalMode8 = $decimalMode8;

        return $this;
    }

    /**
     * Get decimalMode8
     *
     * @return string
     */
    public function getDecimalMode8()
    {
        return $this->decimalMode8;
    }

    /**
     * Set decimalMode9
     *
     * @param string $decimalMode9
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode9($decimalMode9)
    {
        $this->decimalMode9 = $decimalMode9;

        return $this;
    }

    /**
     * Get decimalMode9
     *
     * @return string
     */
    public function getDecimalMode9()
    {
        return $this->decimalMode9;
    }

    /**
     * Set decimalMode10
     *
     * @param string $decimalMode10
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode10($decimalMode10)
    {
        $this->decimalMode10 = $decimalMode10;

        return $this;
    }

    /**
     * Get decimalMode10
     *
     * @return string
     */
    public function getDecimalMode10()
    {
        return $this->decimalMode10;
    }

    /**
     * Set decimalMode11
     *
     * @param string $decimalMode11
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode11($decimalMode11)
    {
        $this->decimalMode11 = $decimalMode11;

        return $this;
    }

    /**
     * Get decimalMode11
     *
     * @return string
     */
    public function getDecimalMode11()
    {
        return $this->decimalMode11;
    }

    /**
     * Set decimalMode12
     *
     * @param string $decimalMode12
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode12($decimalMode12)
    {
        $this->decimalMode12 = $decimalMode12;

        return $this;
    }

    /**
     * Get decimalMode12
     *
     * @return string
     */
    public function getDecimalMode12()
    {
        return $this->decimalMode12;
    }

    /**
     * Set decimalMode13
     *
     * @param string $decimalMode13
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode13($decimalMode13)
    {
        $this->decimalMode13 = $decimalMode13;

        return $this;
    }

    /**
     * Get decimalMode13
     *
     * @return string
     */
    public function getDecimalMode13()
    {
        return $this->decimalMode13;
    }

    /**
     * Set decimalMode14
     *
     * @param string $decimalMode14
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode14($decimalMode14)
    {
        $this->decimalMode14 = $decimalMode14;

        return $this;
    }

    /**
     * Get decimalMode14
     *
     * @return string
     */
    public function getDecimalMode14()
    {
        return $this->decimalMode14;
    }

    /**
     * Set decimalMode15
     *
     * @param string $decimalMode15
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode15($decimalMode15)
    {
        $this->decimalMode15 = $decimalMode15;

        return $this;
    }

    /**
     * Get decimalMode15
     *
     * @return string
     */
    public function getDecimalMode15()
    {
        return $this->decimalMode15;
    }

    /**
     * Set decimalMode16
     *
     * @param string $decimalMode16
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode16($decimalMode16)
    {
        $this->decimalMode16 = $decimalMode16;

        return $this;
    }

    /**
     * Get decimalMode16
     *
     * @return string
     */
    public function getDecimalMode16()
    {
        return $this->decimalMode16;
    }

    /**
     * Set decimalMode17
     *
     * @param string $decimalMode17
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode17($decimalMode17)
    {
        $this->decimalMode17 = $decimalMode17;

        return $this;
    }

    /**
     * Get decimalMode17
     *
     * @return string
     */
    public function getDecimalMode17()
    {
        return $this->decimalMode17;
    }

    /**
     * Set decimalMode18
     *
     * @param string $decimalMode18
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode18($decimalMode18)
    {
        $this->decimalMode18 = $decimalMode18;

        return $this;
    }

    /**
     * Get decimalMode18
     *
     * @return string
     */
    public function getDecimalMode18()
    {
        return $this->decimalMode18;
    }

    /**
     * Set decimalMode19
     *
     * @param string $decimalMode19
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode19($decimalMode19)
    {
        $this->decimalMode19 = $decimalMode19;

        return $this;
    }

    /**
     * Get decimalMode19
     *
     * @return string
     */
    public function getDecimalMode19()
    {
        return $this->decimalMode19;
    }

    /**
     * Set decimalMode20
     *
     * @param string $decimalMode20
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode20($decimalMode20)
    {
        $this->decimalMode20 = $decimalMode20;

        return $this;
    }

    /**
     * Get decimalMode20
     *
     * @return string
     */
    public function getDecimalMode20()
    {
        return $this->decimalMode20;
    }

    /**
     * Set decimalMode21
     *
     * @param string $decimalMode21
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode21($decimalMode21)
    {
        $this->decimalMode21 = $decimalMode21;

        return $this;
    }

    /**
     * Get decimalMode21
     *
     * @return string
     */
    public function getDecimalMode21()
    {
        return $this->decimalMode21;
    }

    /**
     * Set decimalMode22
     *
     * @param string $decimalMode22
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode22($decimalMode22)
    {
        $this->decimalMode22 = $decimalMode22;

        return $this;
    }

    /**
     * Get decimalMode22
     *
     * @return string
     */
    public function getDecimalMode22()
    {
        return $this->decimalMode22;
    }

    /**
     * Set decimalMode23
     *
     * @param string $decimalMode23
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode23($decimalMode23)
    {
        $this->decimalMode23 = $decimalMode23;

        return $this;
    }

    /**
     * Get decimalMode23
     *
     * @return string
     */
    public function getDecimalMode23()
    {
        return $this->decimalMode23;
    }

    /**
     * Set decimalMode24
     *
     * @param string $decimalMode24
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode24($decimalMode24)
    {
        $this->decimalMode24 = $decimalMode24;

        return $this;
    }

    /**
     * Get decimalMode24
     *
     * @return string
     */
    public function getDecimalMode24()
    {
        return $this->decimalMode24;
    }

    /**
     * Set decimalMode25
     *
     * @param string $decimalMode25
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode25($decimalMode25)
    {
        $this->decimalMode25 = $decimalMode25;

        return $this;
    }

    /**
     * Get decimalMode25
     *
     * @return string
     */
    public function getDecimalMode25()
    {
        return $this->decimalMode25;
    }

    /**
     * Set decimalMode26
     *
     * @param string $decimalMode26
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode26($decimalMode26)
    {
        $this->decimalMode26 = $decimalMode26;

        return $this;
    }

    /**
     * Get decimalMode26
     *
     * @return string
     */
    public function getDecimalMode26()
    {
        return $this->decimalMode26;
    }

    /**
     * Set decimalMode27
     *
     * @param string $decimalMode27
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode27($decimalMode27)
    {
        $this->decimalMode27 = $decimalMode27;

        return $this;
    }

    /**
     * Get decimalMode27
     *
     * @return string
     */
    public function getDecimalMode27()
    {
        return $this->decimalMode27;
    }

    /**
     * Set decimalMode28
     *
     * @param string $decimalMode28
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode28($decimalMode28)
    {
        $this->decimalMode28 = $decimalMode28;

        return $this;
    }

    /**
     * Get decimalMode28
     *
     * @return string
     */
    public function getDecimalMode28()
    {
        return $this->decimalMode28;
    }

    /**
     * Set decimalMode29
     *
     * @param string $decimalMode29
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode29($decimalMode29)
    {
        $this->decimalMode29 = $decimalMode29;

        return $this;
    }

    /**
     * Get decimalMode29
     *
     * @return string
     */
    public function getDecimalMode29()
    {
        return $this->decimalMode29;
    }

    /**
     * Set decimalMode30
     *
     * @param string $decimalMode30
     *
     * @return CategoryDistribution
     */
    public function setDecimalMode30($decimalMode30)
    {
        $this->decimalMode30 = $decimalMode30;

        return $this;
    }

    /**
     * Get decimalMode30
     *
     * @return string
     */
    public function getDecimalMode30()
    {
        return $this->decimalMode30;
    }

    /**
     * Set decimalMedian1
     *
     * @param string $decimalMedian1
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian1($decimalMedian1)
    {
        $this->decimalMedian1 = $decimalMedian1;

        return $this;
    }

    /**
     * Get decimalMedian1
     *
     * @return string
     */
    public function getDecimalMedian1()
    {
        return $this->decimalMedian1;
    }

    /**
     * Set decimalMedian2
     *
     * @param string $decimalMedian2
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian2($decimalMedian2)
    {
        $this->decimalMedian2 = $decimalMedian2;

        return $this;
    }

    /**
     * Get decimalMedian2
     *
     * @return string
     */
    public function getDecimalMedian2()
    {
        return $this->decimalMedian2;
    }

    /**
     * Set decimalMedian3
     *
     * @param string $decimalMedian3
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian3($decimalMedian3)
    {
        $this->decimalMedian3 = $decimalMedian3;

        return $this;
    }

    /**
     * Get decimalMedian3
     *
     * @return string
     */
    public function getDecimalMedian3()
    {
        return $this->decimalMedian3;
    }

    /**
     * Set decimalMedian4
     *
     * @param string $decimalMedian4
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian4($decimalMedian4)
    {
        $this->decimalMedian4 = $decimalMedian4;

        return $this;
    }

    /**
     * Get decimalMedian4
     *
     * @return string
     */
    public function getDecimalMedian4()
    {
        return $this->decimalMedian4;
    }

    /**
     * Set decimalMedian5
     *
     * @param string $decimalMedian5
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian5($decimalMedian5)
    {
        $this->decimalMedian5 = $decimalMedian5;

        return $this;
    }

    /**
     * Get decimalMedian5
     *
     * @return string
     */
    public function getDecimalMedian5()
    {
        return $this->decimalMedian5;
    }

    /**
     * Set decimalMedian6
     *
     * @param string $decimalMedian6
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian6($decimalMedian6)
    {
        $this->decimalMedian6 = $decimalMedian6;

        return $this;
    }

    /**
     * Get decimalMedian6
     *
     * @return string
     */
    public function getDecimalMedian6()
    {
        return $this->decimalMedian6;
    }

    /**
     * Set decimalMedian7
     *
     * @param string $decimalMedian7
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian7($decimalMedian7)
    {
        $this->decimalMedian7 = $decimalMedian7;

        return $this;
    }

    /**
     * Get decimalMedian7
     *
     * @return string
     */
    public function getDecimalMedian7()
    {
        return $this->decimalMedian7;
    }

    /**
     * Set decimalMedian8
     *
     * @param string $decimalMedian8
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian8($decimalMedian8)
    {
        $this->decimalMedian8 = $decimalMedian8;

        return $this;
    }

    /**
     * Get decimalMedian8
     *
     * @return string
     */
    public function getDecimalMedian8()
    {
        return $this->decimalMedian8;
    }

    /**
     * Set decimalMedian9
     *
     * @param string $decimalMedian9
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian9($decimalMedian9)
    {
        $this->decimalMedian9 = $decimalMedian9;

        return $this;
    }

    /**
     * Get decimalMedian9
     *
     * @return string
     */
    public function getDecimalMedian9()
    {
        return $this->decimalMedian9;
    }

    /**
     * Set decimalMedian10
     *
     * @param string $decimalMedian10
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian10($decimalMedian10)
    {
        $this->decimalMedian10 = $decimalMedian10;

        return $this;
    }

    /**
     * Get decimalMedian10
     *
     * @return string
     */
    public function getDecimalMedian10()
    {
        return $this->decimalMedian10;
    }

    /**
     * Set decimalMedian11
     *
     * @param string $decimalMedian11
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian11($decimalMedian11)
    {
        $this->decimalMedian11 = $decimalMedian11;

        return $this;
    }

    /**
     * Get decimalMedian11
     *
     * @return string
     */
    public function getDecimalMedian11()
    {
        return $this->decimalMedian11;
    }

    /**
     * Set decimalMedian12
     *
     * @param string $decimalMedian12
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian12($decimalMedian12)
    {
        $this->decimalMedian12 = $decimalMedian12;

        return $this;
    }

    /**
     * Get decimalMedian12
     *
     * @return string
     */
    public function getDecimalMedian12()
    {
        return $this->decimalMedian12;
    }

    /**
     * Set decimalMedian13
     *
     * @param string $decimalMedian13
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian13($decimalMedian13)
    {
        $this->decimalMedian13 = $decimalMedian13;

        return $this;
    }

    /**
     * Get decimalMedian13
     *
     * @return string
     */
    public function getDecimalMedian13()
    {
        return $this->decimalMedian13;
    }

    /**
     * Set decimalMedian14
     *
     * @param string $decimalMedian14
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian14($decimalMedian14)
    {
        $this->decimalMedian14 = $decimalMedian14;

        return $this;
    }

    /**
     * Get decimalMedian14
     *
     * @return string
     */
    public function getDecimalMedian14()
    {
        return $this->decimalMedian14;
    }

    /**
     * Set decimalMedian15
     *
     * @param string $decimalMedian15
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian15($decimalMedian15)
    {
        $this->decimalMedian15 = $decimalMedian15;

        return $this;
    }

    /**
     * Get decimalMedian15
     *
     * @return string
     */
    public function getDecimalMedian15()
    {
        return $this->decimalMedian15;
    }

    /**
     * Set decimalMedian16
     *
     * @param string $decimalMedian16
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian16($decimalMedian16)
    {
        $this->decimalMedian16 = $decimalMedian16;

        return $this;
    }

    /**
     * Get decimalMedian16
     *
     * @return string
     */
    public function getDecimalMedian16()
    {
        return $this->decimalMedian16;
    }

    /**
     * Set decimalMedian17
     *
     * @param string $decimalMedian17
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian17($decimalMedian17)
    {
        $this->decimalMedian17 = $decimalMedian17;

        return $this;
    }

    /**
     * Get decimalMedian17
     *
     * @return string
     */
    public function getDecimalMedian17()
    {
        return $this->decimalMedian17;
    }

    /**
     * Set decimalMedian18
     *
     * @param string $decimalMedian18
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian18($decimalMedian18)
    {
        $this->decimalMedian18 = $decimalMedian18;

        return $this;
    }

    /**
     * Get decimalMedian18
     *
     * @return string
     */
    public function getDecimalMedian18()
    {
        return $this->decimalMedian18;
    }

    /**
     * Set decimalMedian19
     *
     * @param string $decimalMedian19
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian19($decimalMedian19)
    {
        $this->decimalMedian19 = $decimalMedian19;

        return $this;
    }

    /**
     * Get decimalMedian19
     *
     * @return string
     */
    public function getDecimalMedian19()
    {
        return $this->decimalMedian19;
    }

    /**
     * Set decimalMedian20
     *
     * @param string $decimalMedian20
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian20($decimalMedian20)
    {
        $this->decimalMedian20 = $decimalMedian20;

        return $this;
    }

    /**
     * Get decimalMedian20
     *
     * @return string
     */
    public function getDecimalMedian20()
    {
        return $this->decimalMedian20;
    }

    /**
     * Set decimalMedian21
     *
     * @param string $decimalMedian21
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian21($decimalMedian21)
    {
        $this->decimalMedian21 = $decimalMedian21;

        return $this;
    }

    /**
     * Get decimalMedian21
     *
     * @return string
     */
    public function getDecimalMedian21()
    {
        return $this->decimalMedian21;
    }

    /**
     * Set decimalMedian22
     *
     * @param string $decimalMedian22
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian22($decimalMedian22)
    {
        $this->decimalMedian22 = $decimalMedian22;

        return $this;
    }

    /**
     * Get decimalMedian22
     *
     * @return string
     */
    public function getDecimalMedian22()
    {
        return $this->decimalMedian22;
    }

    /**
     * Set decimalMedian23
     *
     * @param string $decimalMedian23
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian23($decimalMedian23)
    {
        $this->decimalMedian23 = $decimalMedian23;

        return $this;
    }

    /**
     * Get decimalMedian23
     *
     * @return string
     */
    public function getDecimalMedian23()
    {
        return $this->decimalMedian23;
    }

    /**
     * Set decimalMedian24
     *
     * @param string $decimalMedian24
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian24($decimalMedian24)
    {
        $this->decimalMedian24 = $decimalMedian24;

        return $this;
    }

    /**
     * Get decimalMedian24
     *
     * @return string
     */
    public function getDecimalMedian24()
    {
        return $this->decimalMedian24;
    }

    /**
     * Set decimalMedian25
     *
     * @param string $decimalMedian25
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian25($decimalMedian25)
    {
        $this->decimalMedian25 = $decimalMedian25;

        return $this;
    }

    /**
     * Get decimalMedian25
     *
     * @return string
     */
    public function getDecimalMedian25()
    {
        return $this->decimalMedian25;
    }

    /**
     * Set decimalMedian26
     *
     * @param string $decimalMedian26
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian26($decimalMedian26)
    {
        $this->decimalMedian26 = $decimalMedian26;

        return $this;
    }

    /**
     * Get decimalMedian26
     *
     * @return string
     */
    public function getDecimalMedian26()
    {
        return $this->decimalMedian26;
    }

    /**
     * Set decimalMedian27
     *
     * @param string $decimalMedian27
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian27($decimalMedian27)
    {
        $this->decimalMedian27 = $decimalMedian27;

        return $this;
    }

    /**
     * Get decimalMedian27
     *
     * @return string
     */
    public function getDecimalMedian27()
    {
        return $this->decimalMedian27;
    }

    /**
     * Set decimalMedian28
     *
     * @param string $decimalMedian28
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian28($decimalMedian28)
    {
        $this->decimalMedian28 = $decimalMedian28;

        return $this;
    }

    /**
     * Get decimalMedian28
     *
     * @return string
     */
    public function getDecimalMedian28()
    {
        return $this->decimalMedian28;
    }

    /**
     * Set decimalMedian29
     *
     * @param string $decimalMedian29
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian29($decimalMedian29)
    {
        $this->decimalMedian29 = $decimalMedian29;

        return $this;
    }

    /**
     * Get decimalMedian29
     *
     * @return string
     */
    public function getDecimalMedian29()
    {
        return $this->decimalMedian29;
    }

    /**
     * Set decimalMedian30
     *
     * @param string $decimalMedian30
     *
     * @return CategoryDistribution
     */
    public function setDecimalMedian30($decimalMedian30)
    {
        $this->decimalMedian30 = $decimalMedian30;

        return $this;
    }

    /**
     * Get decimalMedian30
     *
     * @return string
     */
    public function getDecimalMedian30()
    {
        return $this->decimalMedian30;
    }

    /**
     * Set integerDistribution1
     *
     * @param string $integerDistribution1
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution1($integerDistribution1)
    {
        $this->integerDistribution1 = $integerDistribution1;

        return $this;
    }

    /**
     * Get integerDistribution1
     *
     * @return string
     */
    public function getIntegerDistribution1()
    {
        return $this->integerDistribution1;
    }

    /**
     * Set integerDistribution2
     *
     * @param string $integerDistribution2
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution2($integerDistribution2)
    {
        $this->integerDistribution2 = $integerDistribution2;

        return $this;
    }

    /**
     * Get integerDistribution2
     *
     * @return string
     */
    public function getIntegerDistribution2()
    {
        return $this->integerDistribution2;
    }

    /**
     * Set integerDistribution3
     *
     * @param string $integerDistribution3
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution3($integerDistribution3)
    {
        $this->integerDistribution3 = $integerDistribution3;

        return $this;
    }

    /**
     * Get integerDistribution3
     *
     * @return string
     */
    public function getIntegerDistribution3()
    {
        return $this->integerDistribution3;
    }

    /**
     * Set integerDistribution4
     *
     * @param string $integerDistribution4
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution4($integerDistribution4)
    {
        $this->integerDistribution4 = $integerDistribution4;

        return $this;
    }

    /**
     * Get integerDistribution4
     *
     * @return string
     */
    public function getIntegerDistribution4()
    {
        return $this->integerDistribution4;
    }

    /**
     * Set integerDistribution5
     *
     * @param string $integerDistribution5
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution5($integerDistribution5)
    {
        $this->integerDistribution5 = $integerDistribution5;

        return $this;
    }

    /**
     * Get integerDistribution5
     *
     * @return string
     */
    public function getIntegerDistribution5()
    {
        return $this->integerDistribution5;
    }

    /**
     * Set integerDistribution6
     *
     * @param string $integerDistribution6
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution6($integerDistribution6)
    {
        $this->integerDistribution6 = $integerDistribution6;

        return $this;
    }

    /**
     * Get integerDistribution6
     *
     * @return string
     */
    public function getIntegerDistribution6()
    {
        return $this->integerDistribution6;
    }

    /**
     * Set integerDistribution7
     *
     * @param string $integerDistribution7
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution7($integerDistribution7)
    {
        $this->integerDistribution7 = $integerDistribution7;

        return $this;
    }

    /**
     * Get integerDistribution7
     *
     * @return string
     */
    public function getIntegerDistribution7()
    {
        return $this->integerDistribution7;
    }

    /**
     * Set integerDistribution8
     *
     * @param string $integerDistribution8
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution8($integerDistribution8)
    {
        $this->integerDistribution8 = $integerDistribution8;

        return $this;
    }

    /**
     * Get integerDistribution8
     *
     * @return string
     */
    public function getIntegerDistribution8()
    {
        return $this->integerDistribution8;
    }

    /**
     * Set integerDistribution9
     *
     * @param string $integerDistribution9
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution9($integerDistribution9)
    {
        $this->integerDistribution9 = $integerDistribution9;

        return $this;
    }

    /**
     * Get integerDistribution9
     *
     * @return string
     */
    public function getIntegerDistribution9()
    {
        return $this->integerDistribution9;
    }

    /**
     * Set integerDistribution10
     *
     * @param string $integerDistribution10
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution10($integerDistribution10)
    {
        $this->integerDistribution10 = $integerDistribution10;

        return $this;
    }

    /**
     * Get integerDistribution10
     *
     * @return string
     */
    public function getIntegerDistribution10()
    {
        return $this->integerDistribution10;
    }

    /**
     * Set integerDistribution11
     *
     * @param string $integerDistribution11
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution11($integerDistribution11)
    {
        $this->integerDistribution11 = $integerDistribution11;

        return $this;
    }

    /**
     * Get integerDistribution11
     *
     * @return string
     */
    public function getIntegerDistribution11()
    {
        return $this->integerDistribution11;
    }

    /**
     * Set integerDistribution12
     *
     * @param string $integerDistribution12
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution12($integerDistribution12)
    {
        $this->integerDistribution12 = $integerDistribution12;

        return $this;
    }

    /**
     * Get integerDistribution12
     *
     * @return string
     */
    public function getIntegerDistribution12()
    {
        return $this->integerDistribution12;
    }

    /**
     * Set integerDistribution13
     *
     * @param string $integerDistribution13
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution13($integerDistribution13)
    {
        $this->integerDistribution13 = $integerDistribution13;

        return $this;
    }

    /**
     * Get integerDistribution13
     *
     * @return string
     */
    public function getIntegerDistribution13()
    {
        return $this->integerDistribution13;
    }

    /**
     * Set integerDistribution14
     *
     * @param string $integerDistribution14
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution14($integerDistribution14)
    {
        $this->integerDistribution14 = $integerDistribution14;

        return $this;
    }

    /**
     * Get integerDistribution14
     *
     * @return string
     */
    public function getIntegerDistribution14()
    {
        return $this->integerDistribution14;
    }

    /**
     * Set integerDistribution15
     *
     * @param string $integerDistribution15
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution15($integerDistribution15)
    {
        $this->integerDistribution15 = $integerDistribution15;

        return $this;
    }

    /**
     * Get integerDistribution15
     *
     * @return string
     */
    public function getIntegerDistribution15()
    {
        return $this->integerDistribution15;
    }

    /**
     * Set integerDistribution16
     *
     * @param string $integerDistribution16
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution16($integerDistribution16)
    {
        $this->integerDistribution16 = $integerDistribution16;

        return $this;
    }

    /**
     * Get integerDistribution16
     *
     * @return string
     */
    public function getIntegerDistribution16()
    {
        return $this->integerDistribution16;
    }

    /**
     * Set integerDistribution17
     *
     * @param string $integerDistribution17
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution17($integerDistribution17)
    {
        $this->integerDistribution17 = $integerDistribution17;

        return $this;
    }

    /**
     * Get integerDistribution17
     *
     * @return string
     */
    public function getIntegerDistribution17()
    {
        return $this->integerDistribution17;
    }

    /**
     * Set integerDistribution18
     *
     * @param string $integerDistribution18
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution18($integerDistribution18)
    {
        $this->integerDistribution18 = $integerDistribution18;

        return $this;
    }

    /**
     * Get integerDistribution18
     *
     * @return string
     */
    public function getIntegerDistribution18()
    {
        return $this->integerDistribution18;
    }

    /**
     * Set integerDistribution19
     *
     * @param string $integerDistribution19
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution19($integerDistribution19)
    {
        $this->integerDistribution19 = $integerDistribution19;

        return $this;
    }

    /**
     * Get integerDistribution19
     *
     * @return string
     */
    public function getIntegerDistribution19()
    {
        return $this->integerDistribution19;
    }

    /**
     * Set integerDistribution20
     *
     * @param string $integerDistribution20
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution20($integerDistribution20)
    {
        $this->integerDistribution20 = $integerDistribution20;

        return $this;
    }

    /**
     * Get integerDistribution20
     *
     * @return string
     */
    public function getIntegerDistribution20()
    {
        return $this->integerDistribution20;
    }

    /**
     * Set integerDistribution21
     *
     * @param string $integerDistribution21
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution21($integerDistribution21)
    {
        $this->integerDistribution21 = $integerDistribution21;

        return $this;
    }

    /**
     * Get integerDistribution21
     *
     * @return string
     */
    public function getIntegerDistribution21()
    {
        return $this->integerDistribution21;
    }

    /**
     * Set integerDistribution22
     *
     * @param string $integerDistribution22
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution22($integerDistribution22)
    {
        $this->integerDistribution22 = $integerDistribution22;

        return $this;
    }

    /**
     * Get integerDistribution22
     *
     * @return string
     */
    public function getIntegerDistribution22()
    {
        return $this->integerDistribution22;
    }

    /**
     * Set integerDistribution23
     *
     * @param string $integerDistribution23
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution23($integerDistribution23)
    {
        $this->integerDistribution23 = $integerDistribution23;

        return $this;
    }

    /**
     * Get integerDistribution23
     *
     * @return string
     */
    public function getIntegerDistribution23()
    {
        return $this->integerDistribution23;
    }

    /**
     * Set integerDistribution24
     *
     * @param string $integerDistribution24
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution24($integerDistribution24)
    {
        $this->integerDistribution24 = $integerDistribution24;

        return $this;
    }

    /**
     * Get integerDistribution24
     *
     * @return string
     */
    public function getIntegerDistribution24()
    {
        return $this->integerDistribution24;
    }

    /**
     * Set integerDistribution25
     *
     * @param string $integerDistribution25
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution25($integerDistribution25)
    {
        $this->integerDistribution25 = $integerDistribution25;

        return $this;
    }

    /**
     * Get integerDistribution25
     *
     * @return string
     */
    public function getIntegerDistribution25()
    {
        return $this->integerDistribution25;
    }

    /**
     * Set integerDistribution26
     *
     * @param string $integerDistribution26
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution26($integerDistribution26)
    {
        $this->integerDistribution26 = $integerDistribution26;

        return $this;
    }

    /**
     * Get integerDistribution26
     *
     * @return string
     */
    public function getIntegerDistribution26()
    {
        return $this->integerDistribution26;
    }

    /**
     * Set integerDistribution27
     *
     * @param string $integerDistribution27
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution27($integerDistribution27)
    {
        $this->integerDistribution27 = $integerDistribution27;

        return $this;
    }

    /**
     * Get integerDistribution27
     *
     * @return string
     */
    public function getIntegerDistribution27()
    {
        return $this->integerDistribution27;
    }

    /**
     * Set integerDistribution28
     *
     * @param string $integerDistribution28
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution28($integerDistribution28)
    {
        $this->integerDistribution28 = $integerDistribution28;

        return $this;
    }

    /**
     * Get integerDistribution28
     *
     * @return string
     */
    public function getIntegerDistribution28()
    {
        return $this->integerDistribution28;
    }

    /**
     * Set integerDistribution29
     *
     * @param string $integerDistribution29
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution29($integerDistribution29)
    {
        $this->integerDistribution29 = $integerDistribution29;

        return $this;
    }

    /**
     * Get integerDistribution29
     *
     * @return string
     */
    public function getIntegerDistribution29()
    {
        return $this->integerDistribution29;
    }

    /**
     * Set integerDistribution30
     *
     * @param string $integerDistribution30
     *
     * @return CategoryDistribution
     */
    public function setIntegerDistribution30($integerDistribution30)
    {
        $this->integerDistribution30 = $integerDistribution30;

        return $this;
    }

    /**
     * Get integerDistribution30
     *
     * @return string
     */
    public function getIntegerDistribution30()
    {
        return $this->integerDistribution30;
    }

    /**
     * Set integerMean1
     *
     * @param string $integerMean1
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean1($integerMean1)
    {
        $this->integerMean1 = $integerMean1;

        return $this;
    }

    /**
     * Get integerMean1
     *
     * @return string
     */
    public function getIntegerMean1()
    {
        return $this->integerMean1;
    }

    /**
     * Set integerMean2
     *
     * @param string $integerMean2
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean2($integerMean2)
    {
        $this->integerMean2 = $integerMean2;

        return $this;
    }

    /**
     * Get integerMean2
     *
     * @return string
     */
    public function getIntegerMean2()
    {
        return $this->integerMean2;
    }

    /**
     * Set integerMean3
     *
     * @param string $integerMean3
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean3($integerMean3)
    {
        $this->integerMean3 = $integerMean3;

        return $this;
    }

    /**
     * Get integerMean3
     *
     * @return string
     */
    public function getIntegerMean3()
    {
        return $this->integerMean3;
    }

    /**
     * Set integerMean4
     *
     * @param string $integerMean4
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean4($integerMean4)
    {
        $this->integerMean4 = $integerMean4;

        return $this;
    }

    /**
     * Get integerMean4
     *
     * @return string
     */
    public function getIntegerMean4()
    {
        return $this->integerMean4;
    }

    /**
     * Set integerMean5
     *
     * @param string $integerMean5
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean5($integerMean5)
    {
        $this->integerMean5 = $integerMean5;

        return $this;
    }

    /**
     * Get integerMean5
     *
     * @return string
     */
    public function getIntegerMean5()
    {
        return $this->integerMean5;
    }

    /**
     * Set integerMean6
     *
     * @param string $integerMean6
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean6($integerMean6)
    {
        $this->integerMean6 = $integerMean6;

        return $this;
    }

    /**
     * Get integerMean6
     *
     * @return string
     */
    public function getIntegerMean6()
    {
        return $this->integerMean6;
    }

    /**
     * Set integerMean7
     *
     * @param string $integerMean7
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean7($integerMean7)
    {
        $this->integerMean7 = $integerMean7;

        return $this;
    }

    /**
     * Get integerMean7
     *
     * @return string
     */
    public function getIntegerMean7()
    {
        return $this->integerMean7;
    }

    /**
     * Set integerMean8
     *
     * @param string $integerMean8
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean8($integerMean8)
    {
        $this->integerMean8 = $integerMean8;

        return $this;
    }

    /**
     * Get integerMean8
     *
     * @return string
     */
    public function getIntegerMean8()
    {
        return $this->integerMean8;
    }

    /**
     * Set integerMean9
     *
     * @param string $integerMean9
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean9($integerMean9)
    {
        $this->integerMean9 = $integerMean9;

        return $this;
    }

    /**
     * Get integerMean9
     *
     * @return string
     */
    public function getIntegerMean9()
    {
        return $this->integerMean9;
    }

    /**
     * Set integerMean10
     *
     * @param string $integerMean10
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean10($integerMean10)
    {
        $this->integerMean10 = $integerMean10;

        return $this;
    }

    /**
     * Get integerMean10
     *
     * @return string
     */
    public function getIntegerMean10()
    {
        return $this->integerMean10;
    }

    /**
     * Set integerMean11
     *
     * @param string $integerMean11
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean11($integerMean11)
    {
        $this->integerMean11 = $integerMean11;

        return $this;
    }

    /**
     * Get integerMean11
     *
     * @return string
     */
    public function getIntegerMean11()
    {
        return $this->integerMean11;
    }

    /**
     * Set integerMean12
     *
     * @param string $integerMean12
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean12($integerMean12)
    {
        $this->integerMean12 = $integerMean12;

        return $this;
    }

    /**
     * Get integerMean12
     *
     * @return string
     */
    public function getIntegerMean12()
    {
        return $this->integerMean12;
    }

    /**
     * Set integerMean13
     *
     * @param string $integerMean13
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean13($integerMean13)
    {
        $this->integerMean13 = $integerMean13;

        return $this;
    }

    /**
     * Get integerMean13
     *
     * @return string
     */
    public function getIntegerMean13()
    {
        return $this->integerMean13;
    }

    /**
     * Set integerMean14
     *
     * @param string $integerMean14
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean14($integerMean14)
    {
        $this->integerMean14 = $integerMean14;

        return $this;
    }

    /**
     * Get integerMean14
     *
     * @return string
     */
    public function getIntegerMean14()
    {
        return $this->integerMean14;
    }

    /**
     * Set integerMean15
     *
     * @param string $integerMean15
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean15($integerMean15)
    {
        $this->integerMean15 = $integerMean15;

        return $this;
    }

    /**
     * Get integerMean15
     *
     * @return string
     */
    public function getIntegerMean15()
    {
        return $this->integerMean15;
    }

    /**
     * Set integerMean16
     *
     * @param string $integerMean16
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean16($integerMean16)
    {
        $this->integerMean16 = $integerMean16;

        return $this;
    }

    /**
     * Get integerMean16
     *
     * @return string
     */
    public function getIntegerMean16()
    {
        return $this->integerMean16;
    }

    /**
     * Set integerMean17
     *
     * @param string $integerMean17
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean17($integerMean17)
    {
        $this->integerMean17 = $integerMean17;

        return $this;
    }

    /**
     * Get integerMean17
     *
     * @return string
     */
    public function getIntegerMean17()
    {
        return $this->integerMean17;
    }

    /**
     * Set integerMean18
     *
     * @param string $integerMean18
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean18($integerMean18)
    {
        $this->integerMean18 = $integerMean18;

        return $this;
    }

    /**
     * Get integerMean18
     *
     * @return string
     */
    public function getIntegerMean18()
    {
        return $this->integerMean18;
    }

    /**
     * Set integerMean19
     *
     * @param string $integerMean19
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean19($integerMean19)
    {
        $this->integerMean19 = $integerMean19;

        return $this;
    }

    /**
     * Get integerMean19
     *
     * @return string
     */
    public function getIntegerMean19()
    {
        return $this->integerMean19;
    }

    /**
     * Set integerMean20
     *
     * @param string $integerMean20
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean20($integerMean20)
    {
        $this->integerMean20 = $integerMean20;

        return $this;
    }

    /**
     * Get integerMean20
     *
     * @return string
     */
    public function getIntegerMean20()
    {
        return $this->integerMean20;
    }

    /**
     * Set integerMean21
     *
     * @param string $integerMean21
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean21($integerMean21)
    {
        $this->integerMean21 = $integerMean21;

        return $this;
    }

    /**
     * Get integerMean21
     *
     * @return string
     */
    public function getIntegerMean21()
    {
        return $this->integerMean21;
    }

    /**
     * Set integerMean22
     *
     * @param string $integerMean22
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean22($integerMean22)
    {
        $this->integerMean22 = $integerMean22;

        return $this;
    }

    /**
     * Get integerMean22
     *
     * @return string
     */
    public function getIntegerMean22()
    {
        return $this->integerMean22;
    }

    /**
     * Set integerMean23
     *
     * @param string $integerMean23
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean23($integerMean23)
    {
        $this->integerMean23 = $integerMean23;

        return $this;
    }

    /**
     * Get integerMean23
     *
     * @return string
     */
    public function getIntegerMean23()
    {
        return $this->integerMean23;
    }

    /**
     * Set integerMean24
     *
     * @param string $integerMean24
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean24($integerMean24)
    {
        $this->integerMean24 = $integerMean24;

        return $this;
    }

    /**
     * Get integerMean24
     *
     * @return string
     */
    public function getIntegerMean24()
    {
        return $this->integerMean24;
    }

    /**
     * Set integerMean25
     *
     * @param string $integerMean25
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean25($integerMean25)
    {
        $this->integerMean25 = $integerMean25;

        return $this;
    }

    /**
     * Get integerMean25
     *
     * @return string
     */
    public function getIntegerMean25()
    {
        return $this->integerMean25;
    }

    /**
     * Set integerMean26
     *
     * @param string $integerMean26
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean26($integerMean26)
    {
        $this->integerMean26 = $integerMean26;

        return $this;
    }

    /**
     * Get integerMean26
     *
     * @return string
     */
    public function getIntegerMean26()
    {
        return $this->integerMean26;
    }

    /**
     * Set integerMean27
     *
     * @param string $integerMean27
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean27($integerMean27)
    {
        $this->integerMean27 = $integerMean27;

        return $this;
    }

    /**
     * Get integerMean27
     *
     * @return string
     */
    public function getIntegerMean27()
    {
        return $this->integerMean27;
    }

    /**
     * Set integerMean28
     *
     * @param string $integerMean28
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean28($integerMean28)
    {
        $this->integerMean28 = $integerMean28;

        return $this;
    }

    /**
     * Get integerMean28
     *
     * @return string
     */
    public function getIntegerMean28()
    {
        return $this->integerMean28;
    }

    /**
     * Set integerMean29
     *
     * @param string $integerMean29
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean29($integerMean29)
    {
        $this->integerMean29 = $integerMean29;

        return $this;
    }

    /**
     * Get integerMean29
     *
     * @return string
     */
    public function getIntegerMean29()
    {
        return $this->integerMean29;
    }

    /**
     * Set integerMean30
     *
     * @param string $integerMean30
     *
     * @return CategoryDistribution
     */
    public function setIntegerMean30($integerMean30)
    {
        $this->integerMean30 = $integerMean30;

        return $this;
    }

    /**
     * Get integerMean30
     *
     * @return string
     */
    public function getIntegerMean30()
    {
        return $this->integerMean30;
    }

    /**
     * Set integerMode1
     *
     * @param integer $integerMode1
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode1($integerMode1)
    {
        $this->integerMode1 = $integerMode1;

        return $this;
    }

    /**
     * Get integerMode1
     *
     * @return integer
     */
    public function getIntegerMode1()
    {
        return $this->integerMode1;
    }

    /**
     * Set integerMode2
     *
     * @param integer $integerMode2
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode2($integerMode2)
    {
        $this->integerMode2 = $integerMode2;

        return $this;
    }

    /**
     * Get integerMode2
     *
     * @return integer
     */
    public function getIntegerMode2()
    {
        return $this->integerMode2;
    }

    /**
     * Set integerMode3
     *
     * @param integer $integerMode3
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode3($integerMode3)
    {
        $this->integerMode3 = $integerMode3;

        return $this;
    }

    /**
     * Get integerMode3
     *
     * @return integer
     */
    public function getIntegerMode3()
    {
        return $this->integerMode3;
    }

    /**
     * Set integerMode4
     *
     * @param integer $integerMode4
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode4($integerMode4)
    {
        $this->integerMode4 = $integerMode4;

        return $this;
    }

    /**
     * Get integerMode4
     *
     * @return integer
     */
    public function getIntegerMode4()
    {
        return $this->integerMode4;
    }

    /**
     * Set integerMode5
     *
     * @param integer $integerMode5
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode5($integerMode5)
    {
        $this->integerMode5 = $integerMode5;

        return $this;
    }

    /**
     * Get integerMode5
     *
     * @return integer
     */
    public function getIntegerMode5()
    {
        return $this->integerMode5;
    }

    /**
     * Set integerMode6
     *
     * @param integer $integerMode6
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode6($integerMode6)
    {
        $this->integerMode6 = $integerMode6;

        return $this;
    }

    /**
     * Get integerMode6
     *
     * @return integer
     */
    public function getIntegerMode6()
    {
        return $this->integerMode6;
    }

    /**
     * Set integerMode7
     *
     * @param integer $integerMode7
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode7($integerMode7)
    {
        $this->integerMode7 = $integerMode7;

        return $this;
    }

    /**
     * Get integerMode7
     *
     * @return integer
     */
    public function getIntegerMode7()
    {
        return $this->integerMode7;
    }

    /**
     * Set integerMode8
     *
     * @param integer $integerMode8
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode8($integerMode8)
    {
        $this->integerMode8 = $integerMode8;

        return $this;
    }

    /**
     * Get integerMode8
     *
     * @return integer
     */
    public function getIntegerMode8()
    {
        return $this->integerMode8;
    }

    /**
     * Set integerMode9
     *
     * @param integer $integerMode9
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode9($integerMode9)
    {
        $this->integerMode9 = $integerMode9;

        return $this;
    }

    /**
     * Get integerMode9
     *
     * @return integer
     */
    public function getIntegerMode9()
    {
        return $this->integerMode9;
    }

    /**
     * Set integerMode10
     *
     * @param integer $integerMode10
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode10($integerMode10)
    {
        $this->integerMode10 = $integerMode10;

        return $this;
    }

    /**
     * Get integerMode10
     *
     * @return integer
     */
    public function getIntegerMode10()
    {
        return $this->integerMode10;
    }

    /**
     * Set integerMode11
     *
     * @param integer $integerMode11
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode11($integerMode11)
    {
        $this->integerMode11 = $integerMode11;

        return $this;
    }

    /**
     * Get integerMode11
     *
     * @return integer
     */
    public function getIntegerMode11()
    {
        return $this->integerMode11;
    }

    /**
     * Set integerMode12
     *
     * @param integer $integerMode12
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode12($integerMode12)
    {
        $this->integerMode12 = $integerMode12;

        return $this;
    }

    /**
     * Get integerMode12
     *
     * @return integer
     */
    public function getIntegerMode12()
    {
        return $this->integerMode12;
    }

    /**
     * Set integerMode13
     *
     * @param integer $integerMode13
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode13($integerMode13)
    {
        $this->integerMode13 = $integerMode13;

        return $this;
    }

    /**
     * Get integerMode13
     *
     * @return integer
     */
    public function getIntegerMode13()
    {
        return $this->integerMode13;
    }

    /**
     * Set integerMode14
     *
     * @param integer $integerMode14
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode14($integerMode14)
    {
        $this->integerMode14 = $integerMode14;

        return $this;
    }

    /**
     * Get integerMode14
     *
     * @return integer
     */
    public function getIntegerMode14()
    {
        return $this->integerMode14;
    }

    /**
     * Set integerMode15
     *
     * @param integer $integerMode15
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode15($integerMode15)
    {
        $this->integerMode15 = $integerMode15;

        return $this;
    }

    /**
     * Get integerMode15
     *
     * @return integer
     */
    public function getIntegerMode15()
    {
        return $this->integerMode15;
    }

    /**
     * Set integerMode16
     *
     * @param integer $integerMode16
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode16($integerMode16)
    {
        $this->integerMode16 = $integerMode16;

        return $this;
    }

    /**
     * Get integerMode16
     *
     * @return integer
     */
    public function getIntegerMode16()
    {
        return $this->integerMode16;
    }

    /**
     * Set integerMode17
     *
     * @param integer $integerMode17
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode17($integerMode17)
    {
        $this->integerMode17 = $integerMode17;

        return $this;
    }

    /**
     * Get integerMode17
     *
     * @return integer
     */
    public function getIntegerMode17()
    {
        return $this->integerMode17;
    }

    /**
     * Set integerMode18
     *
     * @param integer $integerMode18
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode18($integerMode18)
    {
        $this->integerMode18 = $integerMode18;

        return $this;
    }

    /**
     * Get integerMode18
     *
     * @return integer
     */
    public function getIntegerMode18()
    {
        return $this->integerMode18;
    }

    /**
     * Set integerMode19
     *
     * @param integer $integerMode19
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode19($integerMode19)
    {
        $this->integerMode19 = $integerMode19;

        return $this;
    }

    /**
     * Get integerMode19
     *
     * @return integer
     */
    public function getIntegerMode19()
    {
        return $this->integerMode19;
    }

    /**
     * Set integerMode20
     *
     * @param integer $integerMode20
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode20($integerMode20)
    {
        $this->integerMode20 = $integerMode20;

        return $this;
    }

    /**
     * Get integerMode20
     *
     * @return integer
     */
    public function getIntegerMode20()
    {
        return $this->integerMode20;
    }

    /**
     * Set integerMode21
     *
     * @param integer $integerMode21
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode21($integerMode21)
    {
        $this->integerMode21 = $integerMode21;

        return $this;
    }

    /**
     * Get integerMode21
     *
     * @return integer
     */
    public function getIntegerMode21()
    {
        return $this->integerMode21;
    }

    /**
     * Set integerMode22
     *
     * @param integer $integerMode22
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode22($integerMode22)
    {
        $this->integerMode22 = $integerMode22;

        return $this;
    }

    /**
     * Get integerMode22
     *
     * @return integer
     */
    public function getIntegerMode22()
    {
        return $this->integerMode22;
    }

    /**
     * Set integerMode23
     *
     * @param integer $integerMode23
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode23($integerMode23)
    {
        $this->integerMode23 = $integerMode23;

        return $this;
    }

    /**
     * Get integerMode23
     *
     * @return integer
     */
    public function getIntegerMode23()
    {
        return $this->integerMode23;
    }

    /**
     * Set integerMode24
     *
     * @param integer $integerMode24
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode24($integerMode24)
    {
        $this->integerMode24 = $integerMode24;

        return $this;
    }

    /**
     * Get integerMode24
     *
     * @return integer
     */
    public function getIntegerMode24()
    {
        return $this->integerMode24;
    }

    /**
     * Set integerMode25
     *
     * @param integer $integerMode25
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode25($integerMode25)
    {
        $this->integerMode25 = $integerMode25;

        return $this;
    }

    /**
     * Get integerMode25
     *
     * @return integer
     */
    public function getIntegerMode25()
    {
        return $this->integerMode25;
    }

    /**
     * Set integerMode26
     *
     * @param integer $integerMode26
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode26($integerMode26)
    {
        $this->integerMode26 = $integerMode26;

        return $this;
    }

    /**
     * Get integerMode26
     *
     * @return integer
     */
    public function getIntegerMode26()
    {
        return $this->integerMode26;
    }

    /**
     * Set integerMode27
     *
     * @param integer $integerMode27
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode27($integerMode27)
    {
        $this->integerMode27 = $integerMode27;

        return $this;
    }

    /**
     * Get integerMode27
     *
     * @return integer
     */
    public function getIntegerMode27()
    {
        return $this->integerMode27;
    }

    /**
     * Set integerMode28
     *
     * @param integer $integerMode28
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode28($integerMode28)
    {
        $this->integerMode28 = $integerMode28;

        return $this;
    }

    /**
     * Get integerMode28
     *
     * @return integer
     */
    public function getIntegerMode28()
    {
        return $this->integerMode28;
    }

    /**
     * Set integerMode29
     *
     * @param integer $integerMode29
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode29($integerMode29)
    {
        $this->integerMode29 = $integerMode29;

        return $this;
    }

    /**
     * Get integerMode29
     *
     * @return integer
     */
    public function getIntegerMode29()
    {
        return $this->integerMode29;
    }

    /**
     * Set integerMode30
     *
     * @param integer $integerMode30
     *
     * @return CategoryDistribution
     */
    public function setIntegerMode30($integerMode30)
    {
        $this->integerMode30 = $integerMode30;

        return $this;
    }

    /**
     * Get integerMode30
     *
     * @return integer
     */
    public function getIntegerMode30()
    {
        return $this->integerMode30;
    }

    /**
     * Set integerMedian1
     *
     * @param integer $integerMedian1
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian1($integerMedian1)
    {
        $this->integerMedian1 = $integerMedian1;

        return $this;
    }

    /**
     * Get integerMedian1
     *
     * @return integer
     */
    public function getIntegerMedian1()
    {
        return $this->integerMedian1;
    }

    /**
     * Set integerMedian2
     *
     * @param integer $integerMedian2
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian2($integerMedian2)
    {
        $this->integerMedian2 = $integerMedian2;

        return $this;
    }

    /**
     * Get integerMedian2
     *
     * @return integer
     */
    public function getIntegerMedian2()
    {
        return $this->integerMedian2;
    }

    /**
     * Set integerMedian3
     *
     * @param integer $integerMedian3
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian3($integerMedian3)
    {
        $this->integerMedian3 = $integerMedian3;

        return $this;
    }

    /**
     * Get integerMedian3
     *
     * @return integer
     */
    public function getIntegerMedian3()
    {
        return $this->integerMedian3;
    }

    /**
     * Set integerMedian4
     *
     * @param integer $integerMedian4
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian4($integerMedian4)
    {
        $this->integerMedian4 = $integerMedian4;

        return $this;
    }

    /**
     * Get integerMedian4
     *
     * @return integer
     */
    public function getIntegerMedian4()
    {
        return $this->integerMedian4;
    }

    /**
     * Set integerMedian5
     *
     * @param integer $integerMedian5
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian5($integerMedian5)
    {
        $this->integerMedian5 = $integerMedian5;

        return $this;
    }

    /**
     * Get integerMedian5
     *
     * @return integer
     */
    public function getIntegerMedian5()
    {
        return $this->integerMedian5;
    }

    /**
     * Set integerMedian6
     *
     * @param integer $integerMedian6
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian6($integerMedian6)
    {
        $this->integerMedian6 = $integerMedian6;

        return $this;
    }

    /**
     * Get integerMedian6
     *
     * @return integer
     */
    public function getIntegerMedian6()
    {
        return $this->integerMedian6;
    }

    /**
     * Set integerMedian7
     *
     * @param integer $integerMedian7
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian7($integerMedian7)
    {
        $this->integerMedian7 = $integerMedian7;

        return $this;
    }

    /**
     * Get integerMedian7
     *
     * @return integer
     */
    public function getIntegerMedian7()
    {
        return $this->integerMedian7;
    }

    /**
     * Set integerMedian8
     *
     * @param integer $integerMedian8
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian8($integerMedian8)
    {
        $this->integerMedian8 = $integerMedian8;

        return $this;
    }

    /**
     * Get integerMedian8
     *
     * @return integer
     */
    public function getIntegerMedian8()
    {
        return $this->integerMedian8;
    }

    /**
     * Set integerMedian9
     *
     * @param integer $integerMedian9
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian9($integerMedian9)
    {
        $this->integerMedian9 = $integerMedian9;

        return $this;
    }

    /**
     * Get integerMedian9
     *
     * @return integer
     */
    public function getIntegerMedian9()
    {
        return $this->integerMedian9;
    }

    /**
     * Set integerMedian10
     *
     * @param integer $integerMedian10
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian10($integerMedian10)
    {
        $this->integerMedian10 = $integerMedian10;

        return $this;
    }

    /**
     * Get integerMedian10
     *
     * @return integer
     */
    public function getIntegerMedian10()
    {
        return $this->integerMedian10;
    }

    /**
     * Set integerMedian11
     *
     * @param integer $integerMedian11
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian11($integerMedian11)
    {
        $this->integerMedian11 = $integerMedian11;

        return $this;
    }

    /**
     * Get integerMedian11
     *
     * @return integer
     */
    public function getIntegerMedian11()
    {
        return $this->integerMedian11;
    }

    /**
     * Set integerMedian12
     *
     * @param integer $integerMedian12
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian12($integerMedian12)
    {
        $this->integerMedian12 = $integerMedian12;

        return $this;
    }

    /**
     * Get integerMedian12
     *
     * @return integer
     */
    public function getIntegerMedian12()
    {
        return $this->integerMedian12;
    }

    /**
     * Set integerMedian13
     *
     * @param integer $integerMedian13
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian13($integerMedian13)
    {
        $this->integerMedian13 = $integerMedian13;

        return $this;
    }

    /**
     * Get integerMedian13
     *
     * @return integer
     */
    public function getIntegerMedian13()
    {
        return $this->integerMedian13;
    }

    /**
     * Set integerMedian14
     *
     * @param integer $integerMedian14
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian14($integerMedian14)
    {
        $this->integerMedian14 = $integerMedian14;

        return $this;
    }

    /**
     * Get integerMedian14
     *
     * @return integer
     */
    public function getIntegerMedian14()
    {
        return $this->integerMedian14;
    }

    /**
     * Set integerMedian15
     *
     * @param integer $integerMedian15
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian15($integerMedian15)
    {
        $this->integerMedian15 = $integerMedian15;

        return $this;
    }

    /**
     * Get integerMedian15
     *
     * @return integer
     */
    public function getIntegerMedian15()
    {
        return $this->integerMedian15;
    }

    /**
     * Set integerMedian16
     *
     * @param integer $integerMedian16
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian16($integerMedian16)
    {
        $this->integerMedian16 = $integerMedian16;

        return $this;
    }

    /**
     * Get integerMedian16
     *
     * @return integer
     */
    public function getIntegerMedian16()
    {
        return $this->integerMedian16;
    }

    /**
     * Set integerMedian17
     *
     * @param integer $integerMedian17
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian17($integerMedian17)
    {
        $this->integerMedian17 = $integerMedian17;

        return $this;
    }

    /**
     * Get integerMedian17
     *
     * @return integer
     */
    public function getIntegerMedian17()
    {
        return $this->integerMedian17;
    }

    /**
     * Set integerMedian18
     *
     * @param integer $integerMedian18
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian18($integerMedian18)
    {
        $this->integerMedian18 = $integerMedian18;

        return $this;
    }

    /**
     * Get integerMedian18
     *
     * @return integer
     */
    public function getIntegerMedian18()
    {
        return $this->integerMedian18;
    }

    /**
     * Set integerMedian19
     *
     * @param integer $integerMedian19
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian19($integerMedian19)
    {
        $this->integerMedian19 = $integerMedian19;

        return $this;
    }

    /**
     * Get integerMedian19
     *
     * @return integer
     */
    public function getIntegerMedian19()
    {
        return $this->integerMedian19;
    }

    /**
     * Set integerMedian20
     *
     * @param integer $integerMedian20
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian20($integerMedian20)
    {
        $this->integerMedian20 = $integerMedian20;

        return $this;
    }

    /**
     * Get integerMedian20
     *
     * @return integer
     */
    public function getIntegerMedian20()
    {
        return $this->integerMedian20;
    }

    /**
     * Set integerMedian21
     *
     * @param integer $integerMedian21
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian21($integerMedian21)
    {
        $this->integerMedian21 = $integerMedian21;

        return $this;
    }

    /**
     * Get integerMedian21
     *
     * @return integer
     */
    public function getIntegerMedian21()
    {
        return $this->integerMedian21;
    }

    /**
     * Set integerMedian22
     *
     * @param integer $integerMedian22
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian22($integerMedian22)
    {
        $this->integerMedian22 = $integerMedian22;

        return $this;
    }

    /**
     * Get integerMedian22
     *
     * @return integer
     */
    public function getIntegerMedian22()
    {
        return $this->integerMedian22;
    }

    /**
     * Set integerMedian23
     *
     * @param integer $integerMedian23
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian23($integerMedian23)
    {
        $this->integerMedian23 = $integerMedian23;

        return $this;
    }

    /**
     * Get integerMedian23
     *
     * @return integer
     */
    public function getIntegerMedian23()
    {
        return $this->integerMedian23;
    }

    /**
     * Set integerMedian24
     *
     * @param integer $integerMedian24
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian24($integerMedian24)
    {
        $this->integerMedian24 = $integerMedian24;

        return $this;
    }

    /**
     * Get integerMedian24
     *
     * @return integer
     */
    public function getIntegerMedian24()
    {
        return $this->integerMedian24;
    }

    /**
     * Set integerMedian25
     *
     * @param integer $integerMedian25
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian25($integerMedian25)
    {
        $this->integerMedian25 = $integerMedian25;

        return $this;
    }

    /**
     * Get integerMedian25
     *
     * @return integer
     */
    public function getIntegerMedian25()
    {
        return $this->integerMedian25;
    }

    /**
     * Set integerMedian26
     *
     * @param integer $integerMedian26
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian26($integerMedian26)
    {
        $this->integerMedian26 = $integerMedian26;

        return $this;
    }

    /**
     * Get integerMedian26
     *
     * @return integer
     */
    public function getIntegerMedian26()
    {
        return $this->integerMedian26;
    }

    /**
     * Set integerMedian27
     *
     * @param integer $integerMedian27
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian27($integerMedian27)
    {
        $this->integerMedian27 = $integerMedian27;

        return $this;
    }

    /**
     * Get integerMedian27
     *
     * @return integer
     */
    public function getIntegerMedian27()
    {
        return $this->integerMedian27;
    }

    /**
     * Set integerMedian28
     *
     * @param integer $integerMedian28
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian28($integerMedian28)
    {
        $this->integerMedian28 = $integerMedian28;

        return $this;
    }

    /**
     * Get integerMedian28
     *
     * @return integer
     */
    public function getIntegerMedian28()
    {
        return $this->integerMedian28;
    }

    /**
     * Set integerMedian29
     *
     * @param integer $integerMedian29
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian29($integerMedian29)
    {
        $this->integerMedian29 = $integerMedian29;

        return $this;
    }

    /**
     * Get integerMedian29
     *
     * @return integer
     */
    public function getIntegerMedian29()
    {
        return $this->integerMedian29;
    }

    /**
     * Set integerMedian30
     *
     * @param integer $integerMedian30
     *
     * @return CategoryDistribution
     */
    public function setIntegerMedian30($integerMedian30)
    {
        $this->integerMedian30 = $integerMedian30;

        return $this;
    }

    /**
     * Get integerMedian30
     *
     * @return integer
     */
    public function getIntegerMedian30()
    {
        return $this->integerMedian30;
    }

    /**
     * Set stringDistribution1
     *
     * @param string $stringDistribution1
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution1($stringDistribution1)
    {
        $this->stringDistribution1 = $stringDistribution1;

        return $this;
    }

    /**
     * Get stringDistribution1
     *
     * @return string
     */
    public function getStringDistribution1()
    {
        return $this->stringDistribution1;
    }

    /**
     * Set stringDistribution2
     *
     * @param string $stringDistribution2
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution2($stringDistribution2)
    {
        $this->stringDistribution2 = $stringDistribution2;

        return $this;
    }

    /**
     * Get stringDistribution2
     *
     * @return string
     */
    public function getStringDistribution2()
    {
        return $this->stringDistribution2;
    }

    /**
     * Set stringDistribution3
     *
     * @param string $stringDistribution3
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution3($stringDistribution3)
    {
        $this->stringDistribution3 = $stringDistribution3;

        return $this;
    }

    /**
     * Get stringDistribution3
     *
     * @return string
     */
    public function getStringDistribution3()
    {
        return $this->stringDistribution3;
    }

    /**
     * Set stringDistribution4
     *
     * @param string $stringDistribution4
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution4($stringDistribution4)
    {
        $this->stringDistribution4 = $stringDistribution4;

        return $this;
    }

    /**
     * Get stringDistribution4
     *
     * @return string
     */
    public function getStringDistribution4()
    {
        return $this->stringDistribution4;
    }

    /**
     * Set stringDistribution5
     *
     * @param string $stringDistribution5
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution5($stringDistribution5)
    {
        $this->stringDistribution5 = $stringDistribution5;

        return $this;
    }

    /**
     * Get stringDistribution5
     *
     * @return string
     */
    public function getStringDistribution5()
    {
        return $this->stringDistribution5;
    }

    /**
     * Set stringDistribution6
     *
     * @param string $stringDistribution6
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution6($stringDistribution6)
    {
        $this->stringDistribution6 = $stringDistribution6;

        return $this;
    }

    /**
     * Get stringDistribution6
     *
     * @return string
     */
    public function getStringDistribution6()
    {
        return $this->stringDistribution6;
    }

    /**
     * Set stringDistribution7
     *
     * @param string $stringDistribution7
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution7($stringDistribution7)
    {
        $this->stringDistribution7 = $stringDistribution7;

        return $this;
    }

    /**
     * Get stringDistribution7
     *
     * @return string
     */
    public function getStringDistribution7()
    {
        return $this->stringDistribution7;
    }

    /**
     * Set stringDistribution8
     *
     * @param string $stringDistribution8
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution8($stringDistribution8)
    {
        $this->stringDistribution8 = $stringDistribution8;

        return $this;
    }

    /**
     * Get stringDistribution8
     *
     * @return string
     */
    public function getStringDistribution8()
    {
        return $this->stringDistribution8;
    }

    /**
     * Set stringDistribution9
     *
     * @param string $stringDistribution9
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution9($stringDistribution9)
    {
        $this->stringDistribution9 = $stringDistribution9;

        return $this;
    }

    /**
     * Get stringDistribution9
     *
     * @return string
     */
    public function getStringDistribution9()
    {
        return $this->stringDistribution9;
    }

    /**
     * Set stringDistribution10
     *
     * @param string $stringDistribution10
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution10($stringDistribution10)
    {
        $this->stringDistribution10 = $stringDistribution10;

        return $this;
    }

    /**
     * Get stringDistribution10
     *
     * @return string
     */
    public function getStringDistribution10()
    {
        return $this->stringDistribution10;
    }

    /**
     * Set stringDistribution11
     *
     * @param string $stringDistribution11
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution11($stringDistribution11)
    {
        $this->stringDistribution11 = $stringDistribution11;

        return $this;
    }

    /**
     * Get stringDistribution11
     *
     * @return string
     */
    public function getStringDistribution11()
    {
        return $this->stringDistribution11;
    }

    /**
     * Set stringDistribution12
     *
     * @param string $stringDistribution12
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution12($stringDistribution12)
    {
        $this->stringDistribution12 = $stringDistribution12;

        return $this;
    }

    /**
     * Get stringDistribution12
     *
     * @return string
     */
    public function getStringDistribution12()
    {
        return $this->stringDistribution12;
    }

    /**
     * Set stringDistribution13
     *
     * @param string $stringDistribution13
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution13($stringDistribution13)
    {
        $this->stringDistribution13 = $stringDistribution13;

        return $this;
    }

    /**
     * Get stringDistribution13
     *
     * @return string
     */
    public function getStringDistribution13()
    {
        return $this->stringDistribution13;
    }

    /**
     * Set stringDistribution14
     *
     * @param string $stringDistribution14
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution14($stringDistribution14)
    {
        $this->stringDistribution14 = $stringDistribution14;

        return $this;
    }

    /**
     * Get stringDistribution14
     *
     * @return string
     */
    public function getStringDistribution14()
    {
        return $this->stringDistribution14;
    }

    /**
     * Set stringDistribution15
     *
     * @param string $stringDistribution15
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution15($stringDistribution15)
    {
        $this->stringDistribution15 = $stringDistribution15;

        return $this;
    }

    /**
     * Get stringDistribution15
     *
     * @return string
     */
    public function getStringDistribution15()
    {
        return $this->stringDistribution15;
    }

    /**
     * Set stringDistribution16
     *
     * @param string $stringDistribution16
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution16($stringDistribution16)
    {
        $this->stringDistribution16 = $stringDistribution16;

        return $this;
    }

    /**
     * Get stringDistribution16
     *
     * @return string
     */
    public function getStringDistribution16()
    {
        return $this->stringDistribution16;
    }

    /**
     * Set stringDistribution17
     *
     * @param string $stringDistribution17
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution17($stringDistribution17)
    {
        $this->stringDistribution17 = $stringDistribution17;

        return $this;
    }

    /**
     * Get stringDistribution17
     *
     * @return string
     */
    public function getStringDistribution17()
    {
        return $this->stringDistribution17;
    }

    /**
     * Set stringDistribution18
     *
     * @param string $stringDistribution18
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution18($stringDistribution18)
    {
        $this->stringDistribution18 = $stringDistribution18;

        return $this;
    }

    /**
     * Get stringDistribution18
     *
     * @return string
     */
    public function getStringDistribution18()
    {
        return $this->stringDistribution18;
    }

    /**
     * Set stringDistribution19
     *
     * @param string $stringDistribution19
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution19($stringDistribution19)
    {
        $this->stringDistribution19 = $stringDistribution19;

        return $this;
    }

    /**
     * Get stringDistribution19
     *
     * @return string
     */
    public function getStringDistribution19()
    {
        return $this->stringDistribution19;
    }

    /**
     * Set stringDistribution20
     *
     * @param string $stringDistribution20
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution20($stringDistribution20)
    {
        $this->stringDistribution20 = $stringDistribution20;

        return $this;
    }

    /**
     * Get stringDistribution20
     *
     * @return string
     */
    public function getStringDistribution20()
    {
        return $this->stringDistribution20;
    }

    /**
     * Set stringDistribution21
     *
     * @param string $stringDistribution21
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution21($stringDistribution21)
    {
        $this->stringDistribution21 = $stringDistribution21;

        return $this;
    }

    /**
     * Get stringDistribution21
     *
     * @return string
     */
    public function getStringDistribution21()
    {
        return $this->stringDistribution21;
    }

    /**
     * Set stringDistribution22
     *
     * @param string $stringDistribution22
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution22($stringDistribution22)
    {
        $this->stringDistribution22 = $stringDistribution22;

        return $this;
    }

    /**
     * Get stringDistribution22
     *
     * @return string
     */
    public function getStringDistribution22()
    {
        return $this->stringDistribution22;
    }

    /**
     * Set stringDistribution23
     *
     * @param string $stringDistribution23
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution23($stringDistribution23)
    {
        $this->stringDistribution23 = $stringDistribution23;

        return $this;
    }

    /**
     * Get stringDistribution23
     *
     * @return string
     */
    public function getStringDistribution23()
    {
        return $this->stringDistribution23;
    }

    /**
     * Set stringDistribution24
     *
     * @param string $stringDistribution24
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution24($stringDistribution24)
    {
        $this->stringDistribution24 = $stringDistribution24;

        return $this;
    }

    /**
     * Get stringDistribution24
     *
     * @return string
     */
    public function getStringDistribution24()
    {
        return $this->stringDistribution24;
    }

    /**
     * Set stringDistribution25
     *
     * @param string $stringDistribution25
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution25($stringDistribution25)
    {
        $this->stringDistribution25 = $stringDistribution25;

        return $this;
    }

    /**
     * Get stringDistribution25
     *
     * @return string
     */
    public function getStringDistribution25()
    {
        return $this->stringDistribution25;
    }

    /**
     * Set stringDistribution26
     *
     * @param string $stringDistribution26
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution26($stringDistribution26)
    {
        $this->stringDistribution26 = $stringDistribution26;

        return $this;
    }

    /**
     * Get stringDistribution26
     *
     * @return string
     */
    public function getStringDistribution26()
    {
        return $this->stringDistribution26;
    }

    /**
     * Set stringDistribution27
     *
     * @param string $stringDistribution27
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution27($stringDistribution27)
    {
        $this->stringDistribution27 = $stringDistribution27;

        return $this;
    }

    /**
     * Get stringDistribution27
     *
     * @return string
     */
    public function getStringDistribution27()
    {
        return $this->stringDistribution27;
    }

    /**
     * Set stringDistribution28
     *
     * @param string $stringDistribution28
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution28($stringDistribution28)
    {
        $this->stringDistribution28 = $stringDistribution28;

        return $this;
    }

    /**
     * Get stringDistribution28
     *
     * @return string
     */
    public function getStringDistribution28()
    {
        return $this->stringDistribution28;
    }

    /**
     * Set stringDistribution29
     *
     * @param string $stringDistribution29
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution29($stringDistribution29)
    {
        $this->stringDistribution29 = $stringDistribution29;

        return $this;
    }

    /**
     * Get stringDistribution29
     *
     * @return string
     */
    public function getStringDistribution29()
    {
        return $this->stringDistribution29;
    }

    /**
     * Set stringDistribution30
     *
     * @param string $stringDistribution30
     *
     * @return CategoryDistribution
     */
    public function setStringDistribution30($stringDistribution30)
    {
        $this->stringDistribution30 = $stringDistribution30;

        return $this;
    }

    /**
     * Get stringDistribution30
     *
     * @return string
     */
    public function getStringDistribution30()
    {
        return $this->stringDistribution30;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Main\Category $category
     *
     * @return CategoryDistribution
     */
    public function setCategory(\AppBundle\Entity\Main\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Main\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
