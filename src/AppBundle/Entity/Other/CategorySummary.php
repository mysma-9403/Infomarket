<?php

namespace AppBundle\Entity\Other;

class CategorySummary {

	public function offsetExists($offset) {
		if (strpos($offset, 'decimalMin') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMax') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMedian') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMode') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMean') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMin') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMax') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMedian') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMode') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMean') !== false) {
			return true;
		}
		
		if (strpos($offset, 'stringMax') !== false) {
			return true;
		}
		
		if (strpos($offset, 'stringMin') !== false) {
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
	 * @var decimal
	 */
	private $decimalMin1;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin2;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin3;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin4;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin5;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin6;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin7;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin8;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin9;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin10;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin11;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin12;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin13;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin14;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin15;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin16;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin17;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin18;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin19;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin20;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin21;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin22;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin23;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin24;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin25;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin26;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin27;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin28;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin29;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMin30;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax1;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax2;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax3;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax4;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax5;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax6;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax7;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax8;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax9;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax10;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax11;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax12;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax13;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax14;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax15;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax16;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax17;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax18;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax19;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax20;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax21;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax22;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax23;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax24;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax25;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax26;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax27;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax28;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax29;

	/**
	 *
	 * @var decimal
	 */
	private $decimalMax30;

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
	 * @var integer
	 */
	private $integerMin1;

	/**
	 *
	 * @var integer
	 */
	private $integerMin2;

	/**
	 *
	 * @var integer
	 */
	private $integerMin3;

	/**
	 *
	 * @var integer
	 */
	private $integerMin4;

	/**
	 *
	 * @var integer
	 */
	private $integerMin5;

	/**
	 *
	 * @var integer
	 */
	private $integerMin6;

	/**
	 *
	 * @var integer
	 */
	private $integerMin7;

	/**
	 *
	 * @var integer
	 */
	private $integerMin8;

	/**
	 *
	 * @var integer
	 */
	private $integerMin9;

	/**
	 *
	 * @var integer
	 */
	private $integerMin10;

	/**
	 *
	 * @var integer
	 */
	private $integerMin11;

	/**
	 *
	 * @var integer
	 */
	private $integerMin12;

	/**
	 *
	 * @var integer
	 */
	private $integerMin13;

	/**
	 *
	 * @var integer
	 */
	private $integerMin14;

	/**
	 *
	 * @var integer
	 */
	private $integerMin15;

	/**
	 *
	 * @var integer
	 */
	private $integerMin16;

	/**
	 *
	 * @var integer
	 */
	private $integerMin17;

	/**
	 *
	 * @var integer
	 */
	private $integerMin18;

	/**
	 *
	 * @var integer
	 */
	private $integerMin19;

	/**
	 *
	 * @var integer
	 */
	private $integerMin20;

	/**
	 *
	 * @var integer
	 */
	private $integerMin21;

	/**
	 *
	 * @var integer
	 */
	private $integerMin22;

	/**
	 *
	 * @var integer
	 */
	private $integerMin23;

	/**
	 *
	 * @var integer
	 */
	private $integerMin24;

	/**
	 *
	 * @var integer
	 */
	private $integerMin25;

	/**
	 *
	 * @var integer
	 */
	private $integerMin26;

	/**
	 *
	 * @var integer
	 */
	private $integerMin27;

	/**
	 *
	 * @var integer
	 */
	private $integerMin28;

	/**
	 *
	 * @var integer
	 */
	private $integerMin29;

	/**
	 *
	 * @var integer
	 */
	private $integerMin30;

	/**
	 *
	 * @var integer
	 */
	private $integerMax1;

	/**
	 *
	 * @var integer
	 */
	private $integerMax2;

	/**
	 *
	 * @var integer
	 */
	private $integerMax3;

	/**
	 *
	 * @var integer
	 */
	private $integerMax4;

	/**
	 *
	 * @var integer
	 */
	private $integerMax5;

	/**
	 *
	 * @var integer
	 */
	private $integerMax6;

	/**
	 *
	 * @var integer
	 */
	private $integerMax7;

	/**
	 *
	 * @var integer
	 */
	private $integerMax8;

	/**
	 *
	 * @var integer
	 */
	private $integerMax9;

	/**
	 *
	 * @var integer
	 */
	private $integerMax10;

	/**
	 *
	 * @var integer
	 */
	private $integerMax11;

	/**
	 *
	 * @var integer
	 */
	private $integerMax12;

	/**
	 *
	 * @var integer
	 */
	private $integerMax13;

	/**
	 *
	 * @var integer
	 */
	private $integerMax14;

	/**
	 *
	 * @var integer
	 */
	private $integerMax15;

	/**
	 *
	 * @var integer
	 */
	private $integerMax16;

	/**
	 *
	 * @var integer
	 */
	private $integerMax17;

	/**
	 *
	 * @var integer
	 */
	private $integerMax18;

	/**
	 *
	 * @var integer
	 */
	private $integerMax19;

	/**
	 *
	 * @var integer
	 */
	private $integerMax20;

	/**
	 *
	 * @var integer
	 */
	private $integerMax21;

	/**
	 *
	 * @var integer
	 */
	private $integerMax22;

	/**
	 *
	 * @var integer
	 */
	private $integerMax23;

	/**
	 *
	 * @var integer
	 */
	private $integerMax24;

	/**
	 *
	 * @var integer
	 */
	private $integerMax25;

	/**
	 *
	 * @var integer
	 */
	private $integerMax26;

	/**
	 *
	 * @var integer
	 */
	private $integerMax27;

	/**
	 *
	 * @var integer
	 */
	private $integerMax28;

	/**
	 *
	 * @var integer
	 */
	private $integerMax29;

	/**
	 *
	 * @var integer
	 */
	private $integerMax30;

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
	 * @var string
	 */
	private $stringMin1;

	/**
	 *
	 * @var string
	 */
	private $stringMin2;

	/**
	 *
	 * @var string
	 */
	private $stringMin3;

	/**
	 *
	 * @var string
	 */
	private $stringMin4;

	/**
	 *
	 * @var string
	 */
	private $stringMin5;

	/**
	 *
	 * @var string
	 */
	private $stringMin6;

	/**
	 *
	 * @var string
	 */
	private $stringMin7;

	/**
	 *
	 * @var string
	 */
	private $stringMin8;

	/**
	 *
	 * @var string
	 */
	private $stringMin9;

	/**
	 *
	 * @var string
	 */
	private $stringMin10;

	/**
	 *
	 * @var string
	 */
	private $stringMin11;

	/**
	 *
	 * @var string
	 */
	private $stringMin12;

	/**
	 *
	 * @var string
	 */
	private $stringMin13;

	/**
	 *
	 * @var string
	 */
	private $stringMin14;

	/**
	 *
	 * @var string
	 */
	private $stringMin15;

	/**
	 *
	 * @var string
	 */
	private $stringMin16;

	/**
	 *
	 * @var string
	 */
	private $stringMin17;

	/**
	 *
	 * @var string
	 */
	private $stringMin18;

	/**
	 *
	 * @var string
	 */
	private $stringMin19;

	/**
	 *
	 * @var string
	 */
	private $stringMin20;

	/**
	 *
	 * @var string
	 */
	private $stringMin21;

	/**
	 *
	 * @var string
	 */
	private $stringMin22;

	/**
	 *
	 * @var string
	 */
	private $stringMin23;

	/**
	 *
	 * @var string
	 */
	private $stringMin24;

	/**
	 *
	 * @var string
	 */
	private $stringMin25;

	/**
	 *
	 * @var string
	 */
	private $stringMin26;

	/**
	 *
	 * @var string
	 */
	private $stringMin27;

	/**
	 *
	 * @var string
	 */
	private $stringMin28;

	/**
	 *
	 * @var string
	 */
	private $stringMin29;

	/**
	 *
	 * @var string
	 */
	private $stringMin30;

	/**
	 *
	 * @var string
	 */
	private $stringMax1;

	/**
	 *
	 * @var string
	 */
	private $stringMax2;

	/**
	 *
	 * @var string
	 */
	private $stringMax3;

	/**
	 *
	 * @var string
	 */
	private $stringMax4;

	/**
	 *
	 * @var string
	 */
	private $stringMax5;

	/**
	 *
	 * @var string
	 */
	private $stringMax6;

	/**
	 *
	 * @var string
	 */
	private $stringMax7;

	/**
	 *
	 * @var string
	 */
	private $stringMax8;

	/**
	 *
	 * @var string
	 */
	private $stringMax9;

	/**
	 *
	 * @var string
	 */
	private $stringMax10;

	/**
	 *
	 * @var string
	 */
	private $stringMax11;

	/**
	 *
	 * @var string
	 */
	private $stringMax12;

	/**
	 *
	 * @var string
	 */
	private $stringMax13;

	/**
	 *
	 * @var string
	 */
	private $stringMax14;

	/**
	 *
	 * @var string
	 */
	private $stringMax15;

	/**
	 *
	 * @var string
	 */
	private $stringMax16;

	/**
	 *
	 * @var string
	 */
	private $stringMax17;

	/**
	 *
	 * @var string
	 */
	private $stringMax18;

	/**
	 *
	 * @var string
	 */
	private $stringMax19;

	/**
	 *
	 * @var string
	 */
	private $stringMax20;

	/**
	 *
	 * @var string
	 */
	private $stringMax21;

	/**
	 *
	 * @var string
	 */
	private $stringMax22;

	/**
	 *
	 * @var string
	 */
	private $stringMax23;

	/**
	 *
	 * @var string
	 */
	private $stringMax24;

	/**
	 *
	 * @var string
	 */
	private $stringMax25;

	/**
	 *
	 * @var string
	 */
	private $stringMax26;

	/**
	 *
	 * @var string
	 */
	private $stringMax27;

	/**
	 *
	 * @var string
	 */
	private $stringMax28;

	/**
	 *
	 * @var string
	 */
	private $stringMax29;

	/**
	 *
	 * @var string
	 */
	private $stringMax30;

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
	 * Set upToDate
	 *
	 * @param boolean $upToDate        	
	 *
	 * @return CategorySummary
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
	 * Set decimalMin1
	 *
	 * @param string $decimalMin1        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin1($decimalMin1) {
		$this->decimalMin1 = $decimalMin1;
		
		return $this;
	}

	/**
	 * Get decimalMin1
	 *
	 * @return string
	 */
	public function getDecimalMin1() {
		return $this->decimalMin1;
	}

	/**
	 * Set decimalMin2
	 *
	 * @param string $decimalMin2        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin2($decimalMin2) {
		$this->decimalMin2 = $decimalMin2;
		
		return $this;
	}

	/**
	 * Get decimalMin2
	 *
	 * @return string
	 */
	public function getDecimalMin2() {
		return $this->decimalMin2;
	}

	/**
	 * Set decimalMin3
	 *
	 * @param string $decimalMin3        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin3($decimalMin3) {
		$this->decimalMin3 = $decimalMin3;
		
		return $this;
	}

	/**
	 * Get decimalMin3
	 *
	 * @return string
	 */
	public function getDecimalMin3() {
		return $this->decimalMin3;
	}

	/**
	 * Set decimalMin4
	 *
	 * @param string $decimalMin4        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin4($decimalMin4) {
		$this->decimalMin4 = $decimalMin4;
		
		return $this;
	}

	/**
	 * Get decimalMin4
	 *
	 * @return string
	 */
	public function getDecimalMin4() {
		return $this->decimalMin4;
	}

	/**
	 * Set decimalMin5
	 *
	 * @param string $decimalMin5        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin5($decimalMin5) {
		$this->decimalMin5 = $decimalMin5;
		
		return $this;
	}

	/**
	 * Get decimalMin5
	 *
	 * @return string
	 */
	public function getDecimalMin5() {
		return $this->decimalMin5;
	}

	/**
	 * Set decimalMin6
	 *
	 * @param string $decimalMin6        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin6($decimalMin6) {
		$this->decimalMin6 = $decimalMin6;
		
		return $this;
	}

	/**
	 * Get decimalMin6
	 *
	 * @return string
	 */
	public function getDecimalMin6() {
		return $this->decimalMin6;
	}

	/**
	 * Set decimalMin7
	 *
	 * @param string $decimalMin7        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin7($decimalMin7) {
		$this->decimalMin7 = $decimalMin7;
		
		return $this;
	}

	/**
	 * Get decimalMin7
	 *
	 * @return string
	 */
	public function getDecimalMin7() {
		return $this->decimalMin7;
	}

	/**
	 * Set decimalMin8
	 *
	 * @param string $decimalMin8        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin8($decimalMin8) {
		$this->decimalMin8 = $decimalMin8;
		
		return $this;
	}

	/**
	 * Get decimalMin8
	 *
	 * @return string
	 */
	public function getDecimalMin8() {
		return $this->decimalMin8;
	}

	/**
	 * Set decimalMin9
	 *
	 * @param string $decimalMin9        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin9($decimalMin9) {
		$this->decimalMin9 = $decimalMin9;
		
		return $this;
	}

	/**
	 * Get decimalMin9
	 *
	 * @return string
	 */
	public function getDecimalMin9() {
		return $this->decimalMin9;
	}

	/**
	 * Set decimalMin10
	 *
	 * @param string $decimalMin10        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin10($decimalMin10) {
		$this->decimalMin10 = $decimalMin10;
		
		return $this;
	}

	/**
	 * Get decimalMin10
	 *
	 * @return string
	 */
	public function getDecimalMin10() {
		return $this->decimalMin10;
	}

	/**
	 * Set decimalMin11
	 *
	 * @param string $decimalMin11        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin11($decimalMin11) {
		$this->decimalMin11 = $decimalMin11;
		
		return $this;
	}

	/**
	 * Get decimalMin11
	 *
	 * @return string
	 */
	public function getDecimalMin11() {
		return $this->decimalMin11;
	}

	/**
	 * Set decimalMin12
	 *
	 * @param string $decimalMin12        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin12($decimalMin12) {
		$this->decimalMin12 = $decimalMin12;
		
		return $this;
	}

	/**
	 * Get decimalMin12
	 *
	 * @return string
	 */
	public function getDecimalMin12() {
		return $this->decimalMin12;
	}

	/**
	 * Set decimalMin13
	 *
	 * @param string $decimalMin13        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin13($decimalMin13) {
		$this->decimalMin13 = $decimalMin13;
		
		return $this;
	}

	/**
	 * Get decimalMin13
	 *
	 * @return string
	 */
	public function getDecimalMin13() {
		return $this->decimalMin13;
	}

	/**
	 * Set decimalMin14
	 *
	 * @param string $decimalMin14        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin14($decimalMin14) {
		$this->decimalMin14 = $decimalMin14;
		
		return $this;
	}

	/**
	 * Get decimalMin14
	 *
	 * @return string
	 */
	public function getDecimalMin14() {
		return $this->decimalMin14;
	}

	/**
	 * Set decimalMin15
	 *
	 * @param string $decimalMin15        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin15($decimalMin15) {
		$this->decimalMin15 = $decimalMin15;
		
		return $this;
	}

	/**
	 * Get decimalMin15
	 *
	 * @return string
	 */
	public function getDecimalMin15() {
		return $this->decimalMin15;
	}

	/**
	 * Set decimalMin16
	 *
	 * @param string $decimalMin16        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin16($decimalMin16) {
		$this->decimalMin16 = $decimalMin16;
		
		return $this;
	}

	/**
	 * Get decimalMin16
	 *
	 * @return string
	 */
	public function getDecimalMin16() {
		return $this->decimalMin16;
	}

	/**
	 * Set decimalMin17
	 *
	 * @param string $decimalMin17        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin17($decimalMin17) {
		$this->decimalMin17 = $decimalMin17;
		
		return $this;
	}

	/**
	 * Get decimalMin17
	 *
	 * @return string
	 */
	public function getDecimalMin17() {
		return $this->decimalMin17;
	}

	/**
	 * Set decimalMin18
	 *
	 * @param string $decimalMin18        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin18($decimalMin18) {
		$this->decimalMin18 = $decimalMin18;
		
		return $this;
	}

	/**
	 * Get decimalMin18
	 *
	 * @return string
	 */
	public function getDecimalMin18() {
		return $this->decimalMin18;
	}

	/**
	 * Set decimalMin19
	 *
	 * @param string $decimalMin19        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin19($decimalMin19) {
		$this->decimalMin19 = $decimalMin19;
		
		return $this;
	}

	/**
	 * Get decimalMin19
	 *
	 * @return string
	 */
	public function getDecimalMin19() {
		return $this->decimalMin19;
	}

	/**
	 * Set decimalMin20
	 *
	 * @param string $decimalMin20        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin20($decimalMin20) {
		$this->decimalMin20 = $decimalMin20;
		
		return $this;
	}

	/**
	 * Get decimalMin20
	 *
	 * @return string
	 */
	public function getDecimalMin20() {
		return $this->decimalMin20;
	}

	/**
	 * Set decimalMin21
	 *
	 * @param string $decimalMin21        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin21($decimalMin21) {
		$this->decimalMin21 = $decimalMin21;
		
		return $this;
	}

	/**
	 * Get decimalMin21
	 *
	 * @return string
	 */
	public function getDecimalMin21() {
		return $this->decimalMin21;
	}

	/**
	 * Set decimalMin22
	 *
	 * @param string $decimalMin22        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin22($decimalMin22) {
		$this->decimalMin22 = $decimalMin22;
		
		return $this;
	}

	/**
	 * Get decimalMin22
	 *
	 * @return string
	 */
	public function getDecimalMin22() {
		return $this->decimalMin22;
	}

	/**
	 * Set decimalMin23
	 *
	 * @param string $decimalMin23        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin23($decimalMin23) {
		$this->decimalMin23 = $decimalMin23;
		
		return $this;
	}

	/**
	 * Get decimalMin23
	 *
	 * @return string
	 */
	public function getDecimalMin23() {
		return $this->decimalMin23;
	}

	/**
	 * Set decimalMin24
	 *
	 * @param string $decimalMin24        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin24($decimalMin24) {
		$this->decimalMin24 = $decimalMin24;
		
		return $this;
	}

	/**
	 * Get decimalMin24
	 *
	 * @return string
	 */
	public function getDecimalMin24() {
		return $this->decimalMin24;
	}

	/**
	 * Set decimalMin25
	 *
	 * @param string $decimalMin25        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin25($decimalMin25) {
		$this->decimalMin25 = $decimalMin25;
		
		return $this;
	}

	/**
	 * Get decimalMin25
	 *
	 * @return string
	 */
	public function getDecimalMin25() {
		return $this->decimalMin25;
	}

	/**
	 * Set decimalMin26
	 *
	 * @param string $decimalMin26        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin26($decimalMin26) {
		$this->decimalMin26 = $decimalMin26;
		
		return $this;
	}

	/**
	 * Get decimalMin26
	 *
	 * @return string
	 */
	public function getDecimalMin26() {
		return $this->decimalMin26;
	}

	/**
	 * Set decimalMin27
	 *
	 * @param string $decimalMin27        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin27($decimalMin27) {
		$this->decimalMin27 = $decimalMin27;
		
		return $this;
	}

	/**
	 * Get decimalMin27
	 *
	 * @return string
	 */
	public function getDecimalMin27() {
		return $this->decimalMin27;
	}

	/**
	 * Set decimalMin28
	 *
	 * @param string $decimalMin28        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin28($decimalMin28) {
		$this->decimalMin28 = $decimalMin28;
		
		return $this;
	}

	/**
	 * Get decimalMin28
	 *
	 * @return string
	 */
	public function getDecimalMin28() {
		return $this->decimalMin28;
	}

	/**
	 * Set decimalMin29
	 *
	 * @param string $decimalMin29        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin29($decimalMin29) {
		$this->decimalMin29 = $decimalMin29;
		
		return $this;
	}

	/**
	 * Get decimalMin29
	 *
	 * @return string
	 */
	public function getDecimalMin29() {
		return $this->decimalMin29;
	}

	/**
	 * Set decimalMin30
	 *
	 * @param string $decimalMin30        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMin30($decimalMin30) {
		$this->decimalMin30 = $decimalMin30;
		
		return $this;
	}

	/**
	 * Get decimalMin30
	 *
	 * @return string
	 */
	public function getDecimalMin30() {
		return $this->decimalMin30;
	}

	/**
	 * Set decimalMax1
	 *
	 * @param string $decimalMax1        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax1($decimalMax1) {
		$this->decimalMax1 = $decimalMax1;
		
		return $this;
	}

	/**
	 * Get decimalMax1
	 *
	 * @return string
	 */
	public function getDecimalMax1() {
		return $this->decimalMax1;
	}

	/**
	 * Set decimalMax2
	 *
	 * @param string $decimalMax2        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax2($decimalMax2) {
		$this->decimalMax2 = $decimalMax2;
		
		return $this;
	}

	/**
	 * Get decimalMax2
	 *
	 * @return string
	 */
	public function getDecimalMax2() {
		return $this->decimalMax2;
	}

	/**
	 * Set decimalMax3
	 *
	 * @param string $decimalMax3        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax3($decimalMax3) {
		$this->decimalMax3 = $decimalMax3;
		
		return $this;
	}

	/**
	 * Get decimalMax3
	 *
	 * @return string
	 */
	public function getDecimalMax3() {
		return $this->decimalMax3;
	}

	/**
	 * Set decimalMax4
	 *
	 * @param string $decimalMax4        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax4($decimalMax4) {
		$this->decimalMax4 = $decimalMax4;
		
		return $this;
	}

	/**
	 * Get decimalMax4
	 *
	 * @return string
	 */
	public function getDecimalMax4() {
		return $this->decimalMax4;
	}

	/**
	 * Set decimalMax5
	 *
	 * @param string $decimalMax5        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax5($decimalMax5) {
		$this->decimalMax5 = $decimalMax5;
		
		return $this;
	}

	/**
	 * Get decimalMax5
	 *
	 * @return string
	 */
	public function getDecimalMax5() {
		return $this->decimalMax5;
	}

	/**
	 * Set decimalMax6
	 *
	 * @param string $decimalMax6        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax6($decimalMax6) {
		$this->decimalMax6 = $decimalMax6;
		
		return $this;
	}

	/**
	 * Get decimalMax6
	 *
	 * @return string
	 */
	public function getDecimalMax6() {
		return $this->decimalMax6;
	}

	/**
	 * Set decimalMax7
	 *
	 * @param string $decimalMax7        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax7($decimalMax7) {
		$this->decimalMax7 = $decimalMax7;
		
		return $this;
	}

	/**
	 * Get decimalMax7
	 *
	 * @return string
	 */
	public function getDecimalMax7() {
		return $this->decimalMax7;
	}

	/**
	 * Set decimalMax8
	 *
	 * @param string $decimalMax8        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax8($decimalMax8) {
		$this->decimalMax8 = $decimalMax8;
		
		return $this;
	}

	/**
	 * Get decimalMax8
	 *
	 * @return string
	 */
	public function getDecimalMax8() {
		return $this->decimalMax8;
	}

	/**
	 * Set decimalMax9
	 *
	 * @param string $decimalMax9        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax9($decimalMax9) {
		$this->decimalMax9 = $decimalMax9;
		
		return $this;
	}

	/**
	 * Get decimalMax9
	 *
	 * @return string
	 */
	public function getDecimalMax9() {
		return $this->decimalMax9;
	}

	/**
	 * Set decimalMax10
	 *
	 * @param string $decimalMax10        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax10($decimalMax10) {
		$this->decimalMax10 = $decimalMax10;
		
		return $this;
	}

	/**
	 * Get decimalMax10
	 *
	 * @return string
	 */
	public function getDecimalMax10() {
		return $this->decimalMax10;
	}

	/**
	 * Set decimalMax11
	 *
	 * @param string $decimalMax11        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax11($decimalMax11) {
		$this->decimalMax11 = $decimalMax11;
		
		return $this;
	}

	/**
	 * Get decimalMax11
	 *
	 * @return string
	 */
	public function getDecimalMax11() {
		return $this->decimalMax11;
	}

	/**
	 * Set decimalMax12
	 *
	 * @param string $decimalMax12        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax12($decimalMax12) {
		$this->decimalMax12 = $decimalMax12;
		
		return $this;
	}

	/**
	 * Get decimalMax12
	 *
	 * @return string
	 */
	public function getDecimalMax12() {
		return $this->decimalMax12;
	}

	/**
	 * Set decimalMax13
	 *
	 * @param string $decimalMax13        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax13($decimalMax13) {
		$this->decimalMax13 = $decimalMax13;
		
		return $this;
	}

	/**
	 * Get decimalMax13
	 *
	 * @return string
	 */
	public function getDecimalMax13() {
		return $this->decimalMax13;
	}

	/**
	 * Set decimalMax14
	 *
	 * @param string $decimalMax14        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax14($decimalMax14) {
		$this->decimalMax14 = $decimalMax14;
		
		return $this;
	}

	/**
	 * Get decimalMax14
	 *
	 * @return string
	 */
	public function getDecimalMax14() {
		return $this->decimalMax14;
	}

	/**
	 * Set decimalMax15
	 *
	 * @param string $decimalMax15        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax15($decimalMax15) {
		$this->decimalMax15 = $decimalMax15;
		
		return $this;
	}

	/**
	 * Get decimalMax15
	 *
	 * @return string
	 */
	public function getDecimalMax15() {
		return $this->decimalMax15;
	}

	/**
	 * Set decimalMax16
	 *
	 * @param string $decimalMax16        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax16($decimalMax16) {
		$this->decimalMax16 = $decimalMax16;
		
		return $this;
	}

	/**
	 * Get decimalMax16
	 *
	 * @return string
	 */
	public function getDecimalMax16() {
		return $this->decimalMax16;
	}

	/**
	 * Set decimalMax17
	 *
	 * @param string $decimalMax17        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax17($decimalMax17) {
		$this->decimalMax17 = $decimalMax17;
		
		return $this;
	}

	/**
	 * Get decimalMax17
	 *
	 * @return string
	 */
	public function getDecimalMax17() {
		return $this->decimalMax17;
	}

	/**
	 * Set decimalMax18
	 *
	 * @param string $decimalMax18        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax18($decimalMax18) {
		$this->decimalMax18 = $decimalMax18;
		
		return $this;
	}

	/**
	 * Get decimalMax18
	 *
	 * @return string
	 */
	public function getDecimalMax18() {
		return $this->decimalMax18;
	}

	/**
	 * Set decimalMax19
	 *
	 * @param string $decimalMax19        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax19($decimalMax19) {
		$this->decimalMax19 = $decimalMax19;
		
		return $this;
	}

	/**
	 * Get decimalMax19
	 *
	 * @return string
	 */
	public function getDecimalMax19() {
		return $this->decimalMax19;
	}

	/**
	 * Set decimalMax20
	 *
	 * @param string $decimalMax20        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax20($decimalMax20) {
		$this->decimalMax20 = $decimalMax20;
		
		return $this;
	}

	/**
	 * Get decimalMax20
	 *
	 * @return string
	 */
	public function getDecimalMax20() {
		return $this->decimalMax20;
	}

	/**
	 * Set decimalMax21
	 *
	 * @param string $decimalMax21        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax21($decimalMax21) {
		$this->decimalMax21 = $decimalMax21;
		
		return $this;
	}

	/**
	 * Get decimalMax21
	 *
	 * @return string
	 */
	public function getDecimalMax21() {
		return $this->decimalMax21;
	}

	/**
	 * Set decimalMax22
	 *
	 * @param string $decimalMax22        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax22($decimalMax22) {
		$this->decimalMax22 = $decimalMax22;
		
		return $this;
	}

	/**
	 * Get decimalMax22
	 *
	 * @return string
	 */
	public function getDecimalMax22() {
		return $this->decimalMax22;
	}

	/**
	 * Set decimalMax23
	 *
	 * @param string $decimalMax23        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax23($decimalMax23) {
		$this->decimalMax23 = $decimalMax23;
		
		return $this;
	}

	/**
	 * Get decimalMax23
	 *
	 * @return string
	 */
	public function getDecimalMax23() {
		return $this->decimalMax23;
	}

	/**
	 * Set decimalMax24
	 *
	 * @param string $decimalMax24        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax24($decimalMax24) {
		$this->decimalMax24 = $decimalMax24;
		
		return $this;
	}

	/**
	 * Get decimalMax24
	 *
	 * @return string
	 */
	public function getDecimalMax24() {
		return $this->decimalMax24;
	}

	/**
	 * Set decimalMax25
	 *
	 * @param string $decimalMax25        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax25($decimalMax25) {
		$this->decimalMax25 = $decimalMax25;
		
		return $this;
	}

	/**
	 * Get decimalMax25
	 *
	 * @return string
	 */
	public function getDecimalMax25() {
		return $this->decimalMax25;
	}

	/**
	 * Set decimalMax26
	 *
	 * @param string $decimalMax26        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax26($decimalMax26) {
		$this->decimalMax26 = $decimalMax26;
		
		return $this;
	}

	/**
	 * Get decimalMax26
	 *
	 * @return string
	 */
	public function getDecimalMax26() {
		return $this->decimalMax26;
	}

	/**
	 * Set decimalMax27
	 *
	 * @param string $decimalMax27        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax27($decimalMax27) {
		$this->decimalMax27 = $decimalMax27;
		
		return $this;
	}

	/**
	 * Get decimalMax27
	 *
	 * @return string
	 */
	public function getDecimalMax27() {
		return $this->decimalMax27;
	}

	/**
	 * Set decimalMax28
	 *
	 * @param string $decimalMax28        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax28($decimalMax28) {
		$this->decimalMax28 = $decimalMax28;
		
		return $this;
	}

	/**
	 * Get decimalMax28
	 *
	 * @return string
	 */
	public function getDecimalMax28() {
		return $this->decimalMax28;
	}

	/**
	 * Set decimalMax29
	 *
	 * @param string $decimalMax29        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax29($decimalMax29) {
		$this->decimalMax29 = $decimalMax29;
		
		return $this;
	}

	/**
	 * Get decimalMax29
	 *
	 * @return string
	 */
	public function getDecimalMax29() {
		return $this->decimalMax29;
	}

	/**
	 * Set decimalMax30
	 *
	 * @param string $decimalMax30        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMax30($decimalMax30) {
		$this->decimalMax30 = $decimalMax30;
		
		return $this;
	}

	/**
	 * Get decimalMax30
	 *
	 * @return string
	 */
	public function getDecimalMax30() {
		return $this->decimalMax30;
	}

	/**
	 * Set decimalMedian1
	 *
	 * @param string $decimalMedian1        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian1($decimalMedian1) {
		$this->decimalMedian1 = $decimalMedian1;
		
		return $this;
	}

	/**
	 * Get decimalMedian1
	 *
	 * @return string
	 */
	public function getDecimalMedian1() {
		return $this->decimalMedian1;
	}

	/**
	 * Set decimalMedian2
	 *
	 * @param string $decimalMedian2        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian2($decimalMedian2) {
		$this->decimalMedian2 = $decimalMedian2;
		
		return $this;
	}

	/**
	 * Get decimalMedian2
	 *
	 * @return string
	 */
	public function getDecimalMedian2() {
		return $this->decimalMedian2;
	}

	/**
	 * Set decimalMedian3
	 *
	 * @param string $decimalMedian3        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian3($decimalMedian3) {
		$this->decimalMedian3 = $decimalMedian3;
		
		return $this;
	}

	/**
	 * Get decimalMedian3
	 *
	 * @return string
	 */
	public function getDecimalMedian3() {
		return $this->decimalMedian3;
	}

	/**
	 * Set decimalMedian4
	 *
	 * @param string $decimalMedian4        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian4($decimalMedian4) {
		$this->decimalMedian4 = $decimalMedian4;
		
		return $this;
	}

	/**
	 * Get decimalMedian4
	 *
	 * @return string
	 */
	public function getDecimalMedian4() {
		return $this->decimalMedian4;
	}

	/**
	 * Set decimalMedian5
	 *
	 * @param string $decimalMedian5        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian5($decimalMedian5) {
		$this->decimalMedian5 = $decimalMedian5;
		
		return $this;
	}

	/**
	 * Get decimalMedian5
	 *
	 * @return string
	 */
	public function getDecimalMedian5() {
		return $this->decimalMedian5;
	}

	/**
	 * Set decimalMedian6
	 *
	 * @param string $decimalMedian6        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian6($decimalMedian6) {
		$this->decimalMedian6 = $decimalMedian6;
		
		return $this;
	}

	/**
	 * Get decimalMedian6
	 *
	 * @return string
	 */
	public function getDecimalMedian6() {
		return $this->decimalMedian6;
	}

	/**
	 * Set decimalMedian7
	 *
	 * @param string $decimalMedian7        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian7($decimalMedian7) {
		$this->decimalMedian7 = $decimalMedian7;
		
		return $this;
	}

	/**
	 * Get decimalMedian7
	 *
	 * @return string
	 */
	public function getDecimalMedian7() {
		return $this->decimalMedian7;
	}

	/**
	 * Set decimalMedian8
	 *
	 * @param string $decimalMedian8        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian8($decimalMedian8) {
		$this->decimalMedian8 = $decimalMedian8;
		
		return $this;
	}

	/**
	 * Get decimalMedian8
	 *
	 * @return string
	 */
	public function getDecimalMedian8() {
		return $this->decimalMedian8;
	}

	/**
	 * Set decimalMedian9
	 *
	 * @param string $decimalMedian9        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian9($decimalMedian9) {
		$this->decimalMedian9 = $decimalMedian9;
		
		return $this;
	}

	/**
	 * Get decimalMedian9
	 *
	 * @return string
	 */
	public function getDecimalMedian9() {
		return $this->decimalMedian9;
	}

	/**
	 * Set decimalMedian10
	 *
	 * @param string $decimalMedian10        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian10($decimalMedian10) {
		$this->decimalMedian10 = $decimalMedian10;
		
		return $this;
	}

	/**
	 * Get decimalMedian10
	 *
	 * @return string
	 */
	public function getDecimalMedian10() {
		return $this->decimalMedian10;
	}

	/**
	 * Set decimalMedian11
	 *
	 * @param string $decimalMedian11        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian11($decimalMedian11) {
		$this->decimalMedian11 = $decimalMedian11;
		
		return $this;
	}

	/**
	 * Get decimalMedian11
	 *
	 * @return string
	 */
	public function getDecimalMedian11() {
		return $this->decimalMedian11;
	}

	/**
	 * Set decimalMedian12
	 *
	 * @param string $decimalMedian12        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian12($decimalMedian12) {
		$this->decimalMedian12 = $decimalMedian12;
		
		return $this;
	}

	/**
	 * Get decimalMedian12
	 *
	 * @return string
	 */
	public function getDecimalMedian12() {
		return $this->decimalMedian12;
	}

	/**
	 * Set decimalMedian13
	 *
	 * @param string $decimalMedian13        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian13($decimalMedian13) {
		$this->decimalMedian13 = $decimalMedian13;
		
		return $this;
	}

	/**
	 * Get decimalMedian13
	 *
	 * @return string
	 */
	public function getDecimalMedian13() {
		return $this->decimalMedian13;
	}

	/**
	 * Set decimalMedian14
	 *
	 * @param string $decimalMedian14        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian14($decimalMedian14) {
		$this->decimalMedian14 = $decimalMedian14;
		
		return $this;
	}

	/**
	 * Get decimalMedian14
	 *
	 * @return string
	 */
	public function getDecimalMedian14() {
		return $this->decimalMedian14;
	}

	/**
	 * Set decimalMedian15
	 *
	 * @param string $decimalMedian15        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian15($decimalMedian15) {
		$this->decimalMedian15 = $decimalMedian15;
		
		return $this;
	}

	/**
	 * Get decimalMedian15
	 *
	 * @return string
	 */
	public function getDecimalMedian15() {
		return $this->decimalMedian15;
	}

	/**
	 * Set decimalMedian16
	 *
	 * @param string $decimalMedian16        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian16($decimalMedian16) {
		$this->decimalMedian16 = $decimalMedian16;
		
		return $this;
	}

	/**
	 * Get decimalMedian16
	 *
	 * @return string
	 */
	public function getDecimalMedian16() {
		return $this->decimalMedian16;
	}

	/**
	 * Set decimalMedian17
	 *
	 * @param string $decimalMedian17        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian17($decimalMedian17) {
		$this->decimalMedian17 = $decimalMedian17;
		
		return $this;
	}

	/**
	 * Get decimalMedian17
	 *
	 * @return string
	 */
	public function getDecimalMedian17() {
		return $this->decimalMedian17;
	}

	/**
	 * Set decimalMedian18
	 *
	 * @param string $decimalMedian18        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian18($decimalMedian18) {
		$this->decimalMedian18 = $decimalMedian18;
		
		return $this;
	}

	/**
	 * Get decimalMedian18
	 *
	 * @return string
	 */
	public function getDecimalMedian18() {
		return $this->decimalMedian18;
	}

	/**
	 * Set decimalMedian19
	 *
	 * @param string $decimalMedian19        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian19($decimalMedian19) {
		$this->decimalMedian19 = $decimalMedian19;
		
		return $this;
	}

	/**
	 * Get decimalMedian19
	 *
	 * @return string
	 */
	public function getDecimalMedian19() {
		return $this->decimalMedian19;
	}

	/**
	 * Set decimalMedian20
	 *
	 * @param string $decimalMedian20        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian20($decimalMedian20) {
		$this->decimalMedian20 = $decimalMedian20;
		
		return $this;
	}

	/**
	 * Get decimalMedian20
	 *
	 * @return string
	 */
	public function getDecimalMedian20() {
		return $this->decimalMedian20;
	}

	/**
	 * Set decimalMedian21
	 *
	 * @param string $decimalMedian21        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian21($decimalMedian21) {
		$this->decimalMedian21 = $decimalMedian21;
		
		return $this;
	}

	/**
	 * Get decimalMedian21
	 *
	 * @return string
	 */
	public function getDecimalMedian21() {
		return $this->decimalMedian21;
	}

	/**
	 * Set decimalMedian22
	 *
	 * @param string $decimalMedian22        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian22($decimalMedian22) {
		$this->decimalMedian22 = $decimalMedian22;
		
		return $this;
	}

	/**
	 * Get decimalMedian22
	 *
	 * @return string
	 */
	public function getDecimalMedian22() {
		return $this->decimalMedian22;
	}

	/**
	 * Set decimalMedian23
	 *
	 * @param string $decimalMedian23        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian23($decimalMedian23) {
		$this->decimalMedian23 = $decimalMedian23;
		
		return $this;
	}

	/**
	 * Get decimalMedian23
	 *
	 * @return string
	 */
	public function getDecimalMedian23() {
		return $this->decimalMedian23;
	}

	/**
	 * Set decimalMedian24
	 *
	 * @param string $decimalMedian24        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian24($decimalMedian24) {
		$this->decimalMedian24 = $decimalMedian24;
		
		return $this;
	}

	/**
	 * Get decimalMedian24
	 *
	 * @return string
	 */
	public function getDecimalMedian24() {
		return $this->decimalMedian24;
	}

	/**
	 * Set decimalMedian25
	 *
	 * @param string $decimalMedian25        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian25($decimalMedian25) {
		$this->decimalMedian25 = $decimalMedian25;
		
		return $this;
	}

	/**
	 * Get decimalMedian25
	 *
	 * @return string
	 */
	public function getDecimalMedian25() {
		return $this->decimalMedian25;
	}

	/**
	 * Set decimalMedian26
	 *
	 * @param string $decimalMedian26        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian26($decimalMedian26) {
		$this->decimalMedian26 = $decimalMedian26;
		
		return $this;
	}

	/**
	 * Get decimalMedian26
	 *
	 * @return string
	 */
	public function getDecimalMedian26() {
		return $this->decimalMedian26;
	}

	/**
	 * Set decimalMedian27
	 *
	 * @param string $decimalMedian27        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian27($decimalMedian27) {
		$this->decimalMedian27 = $decimalMedian27;
		
		return $this;
	}

	/**
	 * Get decimalMedian27
	 *
	 * @return string
	 */
	public function getDecimalMedian27() {
		return $this->decimalMedian27;
	}

	/**
	 * Set decimalMedian28
	 *
	 * @param string $decimalMedian28        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian28($decimalMedian28) {
		$this->decimalMedian28 = $decimalMedian28;
		
		return $this;
	}

	/**
	 * Get decimalMedian28
	 *
	 * @return string
	 */
	public function getDecimalMedian28() {
		return $this->decimalMedian28;
	}

	/**
	 * Set decimalMedian29
	 *
	 * @param string $decimalMedian29        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian29($decimalMedian29) {
		$this->decimalMedian29 = $decimalMedian29;
		
		return $this;
	}

	/**
	 * Get decimalMedian29
	 *
	 * @return string
	 */
	public function getDecimalMedian29() {
		return $this->decimalMedian29;
	}

	/**
	 * Set decimalMedian30
	 *
	 * @param string $decimalMedian30        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMedian30($decimalMedian30) {
		$this->decimalMedian30 = $decimalMedian30;
		
		return $this;
	}

	/**
	 * Get decimalMedian30
	 *
	 * @return string
	 */
	public function getDecimalMedian30() {
		return $this->decimalMedian30;
	}

	/**
	 * Set decimalMode1
	 *
	 * @param string $decimalMode1        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode1($decimalMode1) {
		$this->decimalMode1 = $decimalMode1;
		
		return $this;
	}

	/**
	 * Get decimalMode1
	 *
	 * @return string
	 */
	public function getDecimalMode1() {
		return $this->decimalMode1;
	}

	/**
	 * Set decimalMode2
	 *
	 * @param string $decimalMode2        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode2($decimalMode2) {
		$this->decimalMode2 = $decimalMode2;
		
		return $this;
	}

	/**
	 * Get decimalMode2
	 *
	 * @return string
	 */
	public function getDecimalMode2() {
		return $this->decimalMode2;
	}

	/**
	 * Set decimalMode3
	 *
	 * @param string $decimalMode3        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode3($decimalMode3) {
		$this->decimalMode3 = $decimalMode3;
		
		return $this;
	}

	/**
	 * Get decimalMode3
	 *
	 * @return string
	 */
	public function getDecimalMode3() {
		return $this->decimalMode3;
	}

	/**
	 * Set decimalMode4
	 *
	 * @param string $decimalMode4        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode4($decimalMode4) {
		$this->decimalMode4 = $decimalMode4;
		
		return $this;
	}

	/**
	 * Get decimalMode4
	 *
	 * @return string
	 */
	public function getDecimalMode4() {
		return $this->decimalMode4;
	}

	/**
	 * Set decimalMode5
	 *
	 * @param string $decimalMode5        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode5($decimalMode5) {
		$this->decimalMode5 = $decimalMode5;
		
		return $this;
	}

	/**
	 * Get decimalMode5
	 *
	 * @return string
	 */
	public function getDecimalMode5() {
		return $this->decimalMode5;
	}

	/**
	 * Set decimalMode6
	 *
	 * @param string $decimalMode6        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode6($decimalMode6) {
		$this->decimalMode6 = $decimalMode6;
		
		return $this;
	}

	/**
	 * Get decimalMode6
	 *
	 * @return string
	 */
	public function getDecimalMode6() {
		return $this->decimalMode6;
	}

	/**
	 * Set decimalMode7
	 *
	 * @param string $decimalMode7        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode7($decimalMode7) {
		$this->decimalMode7 = $decimalMode7;
		
		return $this;
	}

	/**
	 * Get decimalMode7
	 *
	 * @return string
	 */
	public function getDecimalMode7() {
		return $this->decimalMode7;
	}

	/**
	 * Set decimalMode8
	 *
	 * @param string $decimalMode8        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode8($decimalMode8) {
		$this->decimalMode8 = $decimalMode8;
		
		return $this;
	}

	/**
	 * Get decimalMode8
	 *
	 * @return string
	 */
	public function getDecimalMode8() {
		return $this->decimalMode8;
	}

	/**
	 * Set decimalMode9
	 *
	 * @param string $decimalMode9        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode9($decimalMode9) {
		$this->decimalMode9 = $decimalMode9;
		
		return $this;
	}

	/**
	 * Get decimalMode9
	 *
	 * @return string
	 */
	public function getDecimalMode9() {
		return $this->decimalMode9;
	}

	/**
	 * Set decimalMode10
	 *
	 * @param string $decimalMode10        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode10($decimalMode10) {
		$this->decimalMode10 = $decimalMode10;
		
		return $this;
	}

	/**
	 * Get decimalMode10
	 *
	 * @return string
	 */
	public function getDecimalMode10() {
		return $this->decimalMode10;
	}

	/**
	 * Set decimalMode11
	 *
	 * @param string $decimalMode11        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode11($decimalMode11) {
		$this->decimalMode11 = $decimalMode11;
		
		return $this;
	}

	/**
	 * Get decimalMode11
	 *
	 * @return string
	 */
	public function getDecimalMode11() {
		return $this->decimalMode11;
	}

	/**
	 * Set decimalMode12
	 *
	 * @param string $decimalMode12        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode12($decimalMode12) {
		$this->decimalMode12 = $decimalMode12;
		
		return $this;
	}

	/**
	 * Get decimalMode12
	 *
	 * @return string
	 */
	public function getDecimalMode12() {
		return $this->decimalMode12;
	}

	/**
	 * Set decimalMode13
	 *
	 * @param string $decimalMode13        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode13($decimalMode13) {
		$this->decimalMode13 = $decimalMode13;
		
		return $this;
	}

	/**
	 * Get decimalMode13
	 *
	 * @return string
	 */
	public function getDecimalMode13() {
		return $this->decimalMode13;
	}

	/**
	 * Set decimalMode14
	 *
	 * @param string $decimalMode14        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode14($decimalMode14) {
		$this->decimalMode14 = $decimalMode14;
		
		return $this;
	}

	/**
	 * Get decimalMode14
	 *
	 * @return string
	 */
	public function getDecimalMode14() {
		return $this->decimalMode14;
	}

	/**
	 * Set decimalMode15
	 *
	 * @param string $decimalMode15        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode15($decimalMode15) {
		$this->decimalMode15 = $decimalMode15;
		
		return $this;
	}

	/**
	 * Get decimalMode15
	 *
	 * @return string
	 */
	public function getDecimalMode15() {
		return $this->decimalMode15;
	}

	/**
	 * Set decimalMode16
	 *
	 * @param string $decimalMode16        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode16($decimalMode16) {
		$this->decimalMode16 = $decimalMode16;
		
		return $this;
	}

	/**
	 * Get decimalMode16
	 *
	 * @return string
	 */
	public function getDecimalMode16() {
		return $this->decimalMode16;
	}

	/**
	 * Set decimalMode17
	 *
	 * @param string $decimalMode17        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode17($decimalMode17) {
		$this->decimalMode17 = $decimalMode17;
		
		return $this;
	}

	/**
	 * Get decimalMode17
	 *
	 * @return string
	 */
	public function getDecimalMode17() {
		return $this->decimalMode17;
	}

	/**
	 * Set decimalMode18
	 *
	 * @param string $decimalMode18        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode18($decimalMode18) {
		$this->decimalMode18 = $decimalMode18;
		
		return $this;
	}

	/**
	 * Get decimalMode18
	 *
	 * @return string
	 */
	public function getDecimalMode18() {
		return $this->decimalMode18;
	}

	/**
	 * Set decimalMode19
	 *
	 * @param string $decimalMode19        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode19($decimalMode19) {
		$this->decimalMode19 = $decimalMode19;
		
		return $this;
	}

	/**
	 * Get decimalMode19
	 *
	 * @return string
	 */
	public function getDecimalMode19() {
		return $this->decimalMode19;
	}

	/**
	 * Set decimalMode20
	 *
	 * @param string $decimalMode20        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode20($decimalMode20) {
		$this->decimalMode20 = $decimalMode20;
		
		return $this;
	}

	/**
	 * Get decimalMode20
	 *
	 * @return string
	 */
	public function getDecimalMode20() {
		return $this->decimalMode20;
	}

	/**
	 * Set decimalMode21
	 *
	 * @param string $decimalMode21        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode21($decimalMode21) {
		$this->decimalMode21 = $decimalMode21;
		
		return $this;
	}

	/**
	 * Get decimalMode21
	 *
	 * @return string
	 */
	public function getDecimalMode21() {
		return $this->decimalMode21;
	}

	/**
	 * Set decimalMode22
	 *
	 * @param string $decimalMode22        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode22($decimalMode22) {
		$this->decimalMode22 = $decimalMode22;
		
		return $this;
	}

	/**
	 * Get decimalMode22
	 *
	 * @return string
	 */
	public function getDecimalMode22() {
		return $this->decimalMode22;
	}

	/**
	 * Set decimalMode23
	 *
	 * @param string $decimalMode23        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode23($decimalMode23) {
		$this->decimalMode23 = $decimalMode23;
		
		return $this;
	}

	/**
	 * Get decimalMode23
	 *
	 * @return string
	 */
	public function getDecimalMode23() {
		return $this->decimalMode23;
	}

	/**
	 * Set decimalMode24
	 *
	 * @param string $decimalMode24        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode24($decimalMode24) {
		$this->decimalMode24 = $decimalMode24;
		
		return $this;
	}

	/**
	 * Get decimalMode24
	 *
	 * @return string
	 */
	public function getDecimalMode24() {
		return $this->decimalMode24;
	}

	/**
	 * Set decimalMode25
	 *
	 * @param string $decimalMode25        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode25($decimalMode25) {
		$this->decimalMode25 = $decimalMode25;
		
		return $this;
	}

	/**
	 * Get decimalMode25
	 *
	 * @return string
	 */
	public function getDecimalMode25() {
		return $this->decimalMode25;
	}

	/**
	 * Set decimalMode26
	 *
	 * @param string $decimalMode26        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode26($decimalMode26) {
		$this->decimalMode26 = $decimalMode26;
		
		return $this;
	}

	/**
	 * Get decimalMode26
	 *
	 * @return string
	 */
	public function getDecimalMode26() {
		return $this->decimalMode26;
	}

	/**
	 * Set decimalMode27
	 *
	 * @param string $decimalMode27        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode27($decimalMode27) {
		$this->decimalMode27 = $decimalMode27;
		
		return $this;
	}

	/**
	 * Get decimalMode27
	 *
	 * @return string
	 */
	public function getDecimalMode27() {
		return $this->decimalMode27;
	}

	/**
	 * Set decimalMode28
	 *
	 * @param string $decimalMode28        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode28($decimalMode28) {
		$this->decimalMode28 = $decimalMode28;
		
		return $this;
	}

	/**
	 * Get decimalMode28
	 *
	 * @return string
	 */
	public function getDecimalMode28() {
		return $this->decimalMode28;
	}

	/**
	 * Set decimalMode29
	 *
	 * @param string $decimalMode29        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode29($decimalMode29) {
		$this->decimalMode29 = $decimalMode29;
		
		return $this;
	}

	/**
	 * Get decimalMode29
	 *
	 * @return string
	 */
	public function getDecimalMode29() {
		return $this->decimalMode29;
	}

	/**
	 * Set decimalMode30
	 *
	 * @param string $decimalMode30        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMode30($decimalMode30) {
		$this->decimalMode30 = $decimalMode30;
		
		return $this;
	}

	/**
	 * Get decimalMode30
	 *
	 * @return string
	 */
	public function getDecimalMode30() {
		return $this->decimalMode30;
	}

	/**
	 * Set decimalMean1
	 *
	 * @param string $decimalMean1        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean1($decimalMean1) {
		$this->decimalMean1 = $decimalMean1;
		
		return $this;
	}

	/**
	 * Get decimalMean1
	 *
	 * @return string
	 */
	public function getDecimalMean1() {
		return $this->decimalMean1;
	}

	/**
	 * Set decimalMean2
	 *
	 * @param string $decimalMean2        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean2($decimalMean2) {
		$this->decimalMean2 = $decimalMean2;
		
		return $this;
	}

	/**
	 * Get decimalMean2
	 *
	 * @return string
	 */
	public function getDecimalMean2() {
		return $this->decimalMean2;
	}

	/**
	 * Set decimalMean3
	 *
	 * @param string $decimalMean3        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean3($decimalMean3) {
		$this->decimalMean3 = $decimalMean3;
		
		return $this;
	}

	/**
	 * Get decimalMean3
	 *
	 * @return string
	 */
	public function getDecimalMean3() {
		return $this->decimalMean3;
	}

	/**
	 * Set decimalMean4
	 *
	 * @param string $decimalMean4        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean4($decimalMean4) {
		$this->decimalMean4 = $decimalMean4;
		
		return $this;
	}

	/**
	 * Get decimalMean4
	 *
	 * @return string
	 */
	public function getDecimalMean4() {
		return $this->decimalMean4;
	}

	/**
	 * Set decimalMean5
	 *
	 * @param string $decimalMean5        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean5($decimalMean5) {
		$this->decimalMean5 = $decimalMean5;
		
		return $this;
	}

	/**
	 * Get decimalMean5
	 *
	 * @return string
	 */
	public function getDecimalMean5() {
		return $this->decimalMean5;
	}

	/**
	 * Set decimalMean6
	 *
	 * @param string $decimalMean6        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean6($decimalMean6) {
		$this->decimalMean6 = $decimalMean6;
		
		return $this;
	}

	/**
	 * Get decimalMean6
	 *
	 * @return string
	 */
	public function getDecimalMean6() {
		return $this->decimalMean6;
	}

	/**
	 * Set decimalMean7
	 *
	 * @param string $decimalMean7        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean7($decimalMean7) {
		$this->decimalMean7 = $decimalMean7;
		
		return $this;
	}

	/**
	 * Get decimalMean7
	 *
	 * @return string
	 */
	public function getDecimalMean7() {
		return $this->decimalMean7;
	}

	/**
	 * Set decimalMean8
	 *
	 * @param string $decimalMean8        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean8($decimalMean8) {
		$this->decimalMean8 = $decimalMean8;
		
		return $this;
	}

	/**
	 * Get decimalMean8
	 *
	 * @return string
	 */
	public function getDecimalMean8() {
		return $this->decimalMean8;
	}

	/**
	 * Set decimalMean9
	 *
	 * @param string $decimalMean9        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean9($decimalMean9) {
		$this->decimalMean9 = $decimalMean9;
		
		return $this;
	}

	/**
	 * Get decimalMean9
	 *
	 * @return string
	 */
	public function getDecimalMean9() {
		return $this->decimalMean9;
	}

	/**
	 * Set decimalMean10
	 *
	 * @param string $decimalMean10        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean10($decimalMean10) {
		$this->decimalMean10 = $decimalMean10;
		
		return $this;
	}

	/**
	 * Get decimalMean10
	 *
	 * @return string
	 */
	public function getDecimalMean10() {
		return $this->decimalMean10;
	}

	/**
	 * Set decimalMean11
	 *
	 * @param string $decimalMean11        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean11($decimalMean11) {
		$this->decimalMean11 = $decimalMean11;
		
		return $this;
	}

	/**
	 * Get decimalMean11
	 *
	 * @return string
	 */
	public function getDecimalMean11() {
		return $this->decimalMean11;
	}

	/**
	 * Set decimalMean12
	 *
	 * @param string $decimalMean12        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean12($decimalMean12) {
		$this->decimalMean12 = $decimalMean12;
		
		return $this;
	}

	/**
	 * Get decimalMean12
	 *
	 * @return string
	 */
	public function getDecimalMean12() {
		return $this->decimalMean12;
	}

	/**
	 * Set decimalMean13
	 *
	 * @param string $decimalMean13        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean13($decimalMean13) {
		$this->decimalMean13 = $decimalMean13;
		
		return $this;
	}

	/**
	 * Get decimalMean13
	 *
	 * @return string
	 */
	public function getDecimalMean13() {
		return $this->decimalMean13;
	}

	/**
	 * Set decimalMean14
	 *
	 * @param string $decimalMean14        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean14($decimalMean14) {
		$this->decimalMean14 = $decimalMean14;
		
		return $this;
	}

	/**
	 * Get decimalMean14
	 *
	 * @return string
	 */
	public function getDecimalMean14() {
		return $this->decimalMean14;
	}

	/**
	 * Set decimalMean15
	 *
	 * @param string $decimalMean15        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean15($decimalMean15) {
		$this->decimalMean15 = $decimalMean15;
		
		return $this;
	}

	/**
	 * Get decimalMean15
	 *
	 * @return string
	 */
	public function getDecimalMean15() {
		return $this->decimalMean15;
	}

	/**
	 * Set decimalMean16
	 *
	 * @param string $decimalMean16        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean16($decimalMean16) {
		$this->decimalMean16 = $decimalMean16;
		
		return $this;
	}

	/**
	 * Get decimalMean16
	 *
	 * @return string
	 */
	public function getDecimalMean16() {
		return $this->decimalMean16;
	}

	/**
	 * Set decimalMean17
	 *
	 * @param string $decimalMean17        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean17($decimalMean17) {
		$this->decimalMean17 = $decimalMean17;
		
		return $this;
	}

	/**
	 * Get decimalMean17
	 *
	 * @return string
	 */
	public function getDecimalMean17() {
		return $this->decimalMean17;
	}

	/**
	 * Set decimalMean18
	 *
	 * @param string $decimalMean18        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean18($decimalMean18) {
		$this->decimalMean18 = $decimalMean18;
		
		return $this;
	}

	/**
	 * Get decimalMean18
	 *
	 * @return string
	 */
	public function getDecimalMean18() {
		return $this->decimalMean18;
	}

	/**
	 * Set decimalMean19
	 *
	 * @param string $decimalMean19        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean19($decimalMean19) {
		$this->decimalMean19 = $decimalMean19;
		
		return $this;
	}

	/**
	 * Get decimalMean19
	 *
	 * @return string
	 */
	public function getDecimalMean19() {
		return $this->decimalMean19;
	}

	/**
	 * Set decimalMean20
	 *
	 * @param string $decimalMean20        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean20($decimalMean20) {
		$this->decimalMean20 = $decimalMean20;
		
		return $this;
	}

	/**
	 * Get decimalMean20
	 *
	 * @return string
	 */
	public function getDecimalMean20() {
		return $this->decimalMean20;
	}

	/**
	 * Set decimalMean21
	 *
	 * @param string $decimalMean21        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean21($decimalMean21) {
		$this->decimalMean21 = $decimalMean21;
		
		return $this;
	}

	/**
	 * Get decimalMean21
	 *
	 * @return string
	 */
	public function getDecimalMean21() {
		return $this->decimalMean21;
	}

	/**
	 * Set decimalMean22
	 *
	 * @param string $decimalMean22        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean22($decimalMean22) {
		$this->decimalMean22 = $decimalMean22;
		
		return $this;
	}

	/**
	 * Get decimalMean22
	 *
	 * @return string
	 */
	public function getDecimalMean22() {
		return $this->decimalMean22;
	}

	/**
	 * Set decimalMean23
	 *
	 * @param string $decimalMean23        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean23($decimalMean23) {
		$this->decimalMean23 = $decimalMean23;
		
		return $this;
	}

	/**
	 * Get decimalMean23
	 *
	 * @return string
	 */
	public function getDecimalMean23() {
		return $this->decimalMean23;
	}

	/**
	 * Set decimalMean24
	 *
	 * @param string $decimalMean24        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean24($decimalMean24) {
		$this->decimalMean24 = $decimalMean24;
		
		return $this;
	}

	/**
	 * Get decimalMean24
	 *
	 * @return string
	 */
	public function getDecimalMean24() {
		return $this->decimalMean24;
	}

	/**
	 * Set decimalMean25
	 *
	 * @param string $decimalMean25        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean25($decimalMean25) {
		$this->decimalMean25 = $decimalMean25;
		
		return $this;
	}

	/**
	 * Get decimalMean25
	 *
	 * @return string
	 */
	public function getDecimalMean25() {
		return $this->decimalMean25;
	}

	/**
	 * Set decimalMean26
	 *
	 * @param string $decimalMean26        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean26($decimalMean26) {
		$this->decimalMean26 = $decimalMean26;
		
		return $this;
	}

	/**
	 * Get decimalMean26
	 *
	 * @return string
	 */
	public function getDecimalMean26() {
		return $this->decimalMean26;
	}

	/**
	 * Set decimalMean27
	 *
	 * @param string $decimalMean27        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean27($decimalMean27) {
		$this->decimalMean27 = $decimalMean27;
		
		return $this;
	}

	/**
	 * Get decimalMean27
	 *
	 * @return string
	 */
	public function getDecimalMean27() {
		return $this->decimalMean27;
	}

	/**
	 * Set decimalMean28
	 *
	 * @param string $decimalMean28        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean28($decimalMean28) {
		$this->decimalMean28 = $decimalMean28;
		
		return $this;
	}

	/**
	 * Get decimalMean28
	 *
	 * @return string
	 */
	public function getDecimalMean28() {
		return $this->decimalMean28;
	}

	/**
	 * Set decimalMean29
	 *
	 * @param string $decimalMean29        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean29($decimalMean29) {
		$this->decimalMean29 = $decimalMean29;
		
		return $this;
	}

	/**
	 * Get decimalMean29
	 *
	 * @return string
	 */
	public function getDecimalMean29() {
		return $this->decimalMean29;
	}

	/**
	 * Set decimalMean30
	 *
	 * @param string $decimalMean30        	
	 *
	 * @return CategorySummary
	 */
	public function setDecimalMean30($decimalMean30) {
		$this->decimalMean30 = $decimalMean30;
		
		return $this;
	}

	/**
	 * Get decimalMean30
	 *
	 * @return string
	 */
	public function getDecimalMean30() {
		return $this->decimalMean30;
	}

	/**
	 * Set integerMin1
	 *
	 * @param integer $integerMin1        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin1($integerMin1) {
		$this->integerMin1 = $integerMin1;
		
		return $this;
	}

	/**
	 * Get integerMin1
	 *
	 * @return integer
	 */
	public function getIntegerMin1() {
		return $this->integerMin1;
	}

	/**
	 * Set integerMin2
	 *
	 * @param integer $integerMin2        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin2($integerMin2) {
		$this->integerMin2 = $integerMin2;
		
		return $this;
	}

	/**
	 * Get integerMin2
	 *
	 * @return integer
	 */
	public function getIntegerMin2() {
		return $this->integerMin2;
	}

	/**
	 * Set integerMin3
	 *
	 * @param integer $integerMin3        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin3($integerMin3) {
		$this->integerMin3 = $integerMin3;
		
		return $this;
	}

	/**
	 * Get integerMin3
	 *
	 * @return integer
	 */
	public function getIntegerMin3() {
		return $this->integerMin3;
	}

	/**
	 * Set integerMin4
	 *
	 * @param integer $integerMin4        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin4($integerMin4) {
		$this->integerMin4 = $integerMin4;
		
		return $this;
	}

	/**
	 * Get integerMin4
	 *
	 * @return integer
	 */
	public function getIntegerMin4() {
		return $this->integerMin4;
	}

	/**
	 * Set integerMin5
	 *
	 * @param integer $integerMin5        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin5($integerMin5) {
		$this->integerMin5 = $integerMin5;
		
		return $this;
	}

	/**
	 * Get integerMin5
	 *
	 * @return integer
	 */
	public function getIntegerMin5() {
		return $this->integerMin5;
	}

	/**
	 * Set integerMin6
	 *
	 * @param integer $integerMin6        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin6($integerMin6) {
		$this->integerMin6 = $integerMin6;
		
		return $this;
	}

	/**
	 * Get integerMin6
	 *
	 * @return integer
	 */
	public function getIntegerMin6() {
		return $this->integerMin6;
	}

	/**
	 * Set integerMin7
	 *
	 * @param integer $integerMin7        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin7($integerMin7) {
		$this->integerMin7 = $integerMin7;
		
		return $this;
	}

	/**
	 * Get integerMin7
	 *
	 * @return integer
	 */
	public function getIntegerMin7() {
		return $this->integerMin7;
	}

	/**
	 * Set integerMin8
	 *
	 * @param integer $integerMin8        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin8($integerMin8) {
		$this->integerMin8 = $integerMin8;
		
		return $this;
	}

	/**
	 * Get integerMin8
	 *
	 * @return integer
	 */
	public function getIntegerMin8() {
		return $this->integerMin8;
	}

	/**
	 * Set integerMin9
	 *
	 * @param integer $integerMin9        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin9($integerMin9) {
		$this->integerMin9 = $integerMin9;
		
		return $this;
	}

	/**
	 * Get integerMin9
	 *
	 * @return integer
	 */
	public function getIntegerMin9() {
		return $this->integerMin9;
	}

	/**
	 * Set integerMin10
	 *
	 * @param integer $integerMin10        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin10($integerMin10) {
		$this->integerMin10 = $integerMin10;
		
		return $this;
	}

	/**
	 * Get integerMin10
	 *
	 * @return integer
	 */
	public function getIntegerMin10() {
		return $this->integerMin10;
	}

	/**
	 * Set integerMin11
	 *
	 * @param integer $integerMin11        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin11($integerMin11) {
		$this->integerMin11 = $integerMin11;
		
		return $this;
	}

	/**
	 * Get integerMin11
	 *
	 * @return integer
	 */
	public function getIntegerMin11() {
		return $this->integerMin11;
	}

	/**
	 * Set integerMin12
	 *
	 * @param integer $integerMin12        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin12($integerMin12) {
		$this->integerMin12 = $integerMin12;
		
		return $this;
	}

	/**
	 * Get integerMin12
	 *
	 * @return integer
	 */
	public function getIntegerMin12() {
		return $this->integerMin12;
	}

	/**
	 * Set integerMin13
	 *
	 * @param integer $integerMin13        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin13($integerMin13) {
		$this->integerMin13 = $integerMin13;
		
		return $this;
	}

	/**
	 * Get integerMin13
	 *
	 * @return integer
	 */
	public function getIntegerMin13() {
		return $this->integerMin13;
	}

	/**
	 * Set integerMin14
	 *
	 * @param integer $integerMin14        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin14($integerMin14) {
		$this->integerMin14 = $integerMin14;
		
		return $this;
	}

	/**
	 * Get integerMin14
	 *
	 * @return integer
	 */
	public function getIntegerMin14() {
		return $this->integerMin14;
	}

	/**
	 * Set integerMin15
	 *
	 * @param integer $integerMin15        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin15($integerMin15) {
		$this->integerMin15 = $integerMin15;
		
		return $this;
	}

	/**
	 * Get integerMin15
	 *
	 * @return integer
	 */
	public function getIntegerMin15() {
		return $this->integerMin15;
	}

	/**
	 * Set integerMin16
	 *
	 * @param integer $integerMin16        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin16($integerMin16) {
		$this->integerMin16 = $integerMin16;
		
		return $this;
	}

	/**
	 * Get integerMin16
	 *
	 * @return integer
	 */
	public function getIntegerMin16() {
		return $this->integerMin16;
	}

	/**
	 * Set integerMin17
	 *
	 * @param integer $integerMin17        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin17($integerMin17) {
		$this->integerMin17 = $integerMin17;
		
		return $this;
	}

	/**
	 * Get integerMin17
	 *
	 * @return integer
	 */
	public function getIntegerMin17() {
		return $this->integerMin17;
	}

	/**
	 * Set integerMin18
	 *
	 * @param integer $integerMin18        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin18($integerMin18) {
		$this->integerMin18 = $integerMin18;
		
		return $this;
	}

	/**
	 * Get integerMin18
	 *
	 * @return integer
	 */
	public function getIntegerMin18() {
		return $this->integerMin18;
	}

	/**
	 * Set integerMin19
	 *
	 * @param integer $integerMin19        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin19($integerMin19) {
		$this->integerMin19 = $integerMin19;
		
		return $this;
	}

	/**
	 * Get integerMin19
	 *
	 * @return integer
	 */
	public function getIntegerMin19() {
		return $this->integerMin19;
	}

	/**
	 * Set integerMin20
	 *
	 * @param integer $integerMin20        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin20($integerMin20) {
		$this->integerMin20 = $integerMin20;
		
		return $this;
	}

	/**
	 * Get integerMin20
	 *
	 * @return integer
	 */
	public function getIntegerMin20() {
		return $this->integerMin20;
	}

	/**
	 * Set integerMin21
	 *
	 * @param integer $integerMin21        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin21($integerMin21) {
		$this->integerMin21 = $integerMin21;
		
		return $this;
	}

	/**
	 * Get integerMin21
	 *
	 * @return integer
	 */
	public function getIntegerMin21() {
		return $this->integerMin21;
	}

	/**
	 * Set integerMin22
	 *
	 * @param integer $integerMin22        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin22($integerMin22) {
		$this->integerMin22 = $integerMin22;
		
		return $this;
	}

	/**
	 * Get integerMin22
	 *
	 * @return integer
	 */
	public function getIntegerMin22() {
		return $this->integerMin22;
	}

	/**
	 * Set integerMin23
	 *
	 * @param integer $integerMin23        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin23($integerMin23) {
		$this->integerMin23 = $integerMin23;
		
		return $this;
	}

	/**
	 * Get integerMin23
	 *
	 * @return integer
	 */
	public function getIntegerMin23() {
		return $this->integerMin23;
	}

	/**
	 * Set integerMin24
	 *
	 * @param integer $integerMin24        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin24($integerMin24) {
		$this->integerMin24 = $integerMin24;
		
		return $this;
	}

	/**
	 * Get integerMin24
	 *
	 * @return integer
	 */
	public function getIntegerMin24() {
		return $this->integerMin24;
	}

	/**
	 * Set integerMin25
	 *
	 * @param integer $integerMin25        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin25($integerMin25) {
		$this->integerMin25 = $integerMin25;
		
		return $this;
	}

	/**
	 * Get integerMin25
	 *
	 * @return integer
	 */
	public function getIntegerMin25() {
		return $this->integerMin25;
	}

	/**
	 * Set integerMin26
	 *
	 * @param integer $integerMin26        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin26($integerMin26) {
		$this->integerMin26 = $integerMin26;
		
		return $this;
	}

	/**
	 * Get integerMin26
	 *
	 * @return integer
	 */
	public function getIntegerMin26() {
		return $this->integerMin26;
	}

	/**
	 * Set integerMin27
	 *
	 * @param integer $integerMin27        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin27($integerMin27) {
		$this->integerMin27 = $integerMin27;
		
		return $this;
	}

	/**
	 * Get integerMin27
	 *
	 * @return integer
	 */
	public function getIntegerMin27() {
		return $this->integerMin27;
	}

	/**
	 * Set integerMin28
	 *
	 * @param integer $integerMin28        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin28($integerMin28) {
		$this->integerMin28 = $integerMin28;
		
		return $this;
	}

	/**
	 * Get integerMin28
	 *
	 * @return integer
	 */
	public function getIntegerMin28() {
		return $this->integerMin28;
	}

	/**
	 * Set integerMin29
	 *
	 * @param integer $integerMin29        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin29($integerMin29) {
		$this->integerMin29 = $integerMin29;
		
		return $this;
	}

	/**
	 * Get integerMin29
	 *
	 * @return integer
	 */
	public function getIntegerMin29() {
		return $this->integerMin29;
	}

	/**
	 * Set integerMin30
	 *
	 * @param integer $integerMin30        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMin30($integerMin30) {
		$this->integerMin30 = $integerMin30;
		
		return $this;
	}

	/**
	 * Get integerMin30
	 *
	 * @return integer
	 */
	public function getIntegerMin30() {
		return $this->integerMin30;
	}

	/**
	 * Set integerMax1
	 *
	 * @param integer $integerMax1        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax1($integerMax1) {
		$this->integerMax1 = $integerMax1;
		
		return $this;
	}

	/**
	 * Get integerMax1
	 *
	 * @return integer
	 */
	public function getIntegerMax1() {
		return $this->integerMax1;
	}

	/**
	 * Set integerMax2
	 *
	 * @param integer $integerMax2        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax2($integerMax2) {
		$this->integerMax2 = $integerMax2;
		
		return $this;
	}

	/**
	 * Get integerMax2
	 *
	 * @return integer
	 */
	public function getIntegerMax2() {
		return $this->integerMax2;
	}

	/**
	 * Set integerMax3
	 *
	 * @param integer $integerMax3        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax3($integerMax3) {
		$this->integerMax3 = $integerMax3;
		
		return $this;
	}

	/**
	 * Get integerMax3
	 *
	 * @return integer
	 */
	public function getIntegerMax3() {
		return $this->integerMax3;
	}

	/**
	 * Set integerMax4
	 *
	 * @param integer $integerMax4        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax4($integerMax4) {
		$this->integerMax4 = $integerMax4;
		
		return $this;
	}

	/**
	 * Get integerMax4
	 *
	 * @return integer
	 */
	public function getIntegerMax4() {
		return $this->integerMax4;
	}

	/**
	 * Set integerMax5
	 *
	 * @param integer $integerMax5        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax5($integerMax5) {
		$this->integerMax5 = $integerMax5;
		
		return $this;
	}

	/**
	 * Get integerMax5
	 *
	 * @return integer
	 */
	public function getIntegerMax5() {
		return $this->integerMax5;
	}

	/**
	 * Set integerMax6
	 *
	 * @param integer $integerMax6        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax6($integerMax6) {
		$this->integerMax6 = $integerMax6;
		
		return $this;
	}

	/**
	 * Get integerMax6
	 *
	 * @return integer
	 */
	public function getIntegerMax6() {
		return $this->integerMax6;
	}

	/**
	 * Set integerMax7
	 *
	 * @param integer $integerMax7        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax7($integerMax7) {
		$this->integerMax7 = $integerMax7;
		
		return $this;
	}

	/**
	 * Get integerMax7
	 *
	 * @return integer
	 */
	public function getIntegerMax7() {
		return $this->integerMax7;
	}

	/**
	 * Set integerMax8
	 *
	 * @param integer $integerMax8        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax8($integerMax8) {
		$this->integerMax8 = $integerMax8;
		
		return $this;
	}

	/**
	 * Get integerMax8
	 *
	 * @return integer
	 */
	public function getIntegerMax8() {
		return $this->integerMax8;
	}

	/**
	 * Set integerMax9
	 *
	 * @param integer $integerMax9        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax9($integerMax9) {
		$this->integerMax9 = $integerMax9;
		
		return $this;
	}

	/**
	 * Get integerMax9
	 *
	 * @return integer
	 */
	public function getIntegerMax9() {
		return $this->integerMax9;
	}

	/**
	 * Set integerMax10
	 *
	 * @param integer $integerMax10        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax10($integerMax10) {
		$this->integerMax10 = $integerMax10;
		
		return $this;
	}

	/**
	 * Get integerMax10
	 *
	 * @return integer
	 */
	public function getIntegerMax10() {
		return $this->integerMax10;
	}

	/**
	 * Set integerMax11
	 *
	 * @param integer $integerMax11        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax11($integerMax11) {
		$this->integerMax11 = $integerMax11;
		
		return $this;
	}

	/**
	 * Get integerMax11
	 *
	 * @return integer
	 */
	public function getIntegerMax11() {
		return $this->integerMax11;
	}

	/**
	 * Set integerMax12
	 *
	 * @param integer $integerMax12        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax12($integerMax12) {
		$this->integerMax12 = $integerMax12;
		
		return $this;
	}

	/**
	 * Get integerMax12
	 *
	 * @return integer
	 */
	public function getIntegerMax12() {
		return $this->integerMax12;
	}

	/**
	 * Set integerMax13
	 *
	 * @param integer $integerMax13        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax13($integerMax13) {
		$this->integerMax13 = $integerMax13;
		
		return $this;
	}

	/**
	 * Get integerMax13
	 *
	 * @return integer
	 */
	public function getIntegerMax13() {
		return $this->integerMax13;
	}

	/**
	 * Set integerMax14
	 *
	 * @param integer $integerMax14        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax14($integerMax14) {
		$this->integerMax14 = $integerMax14;
		
		return $this;
	}

	/**
	 * Get integerMax14
	 *
	 * @return integer
	 */
	public function getIntegerMax14() {
		return $this->integerMax14;
	}

	/**
	 * Set integerMax15
	 *
	 * @param integer $integerMax15        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax15($integerMax15) {
		$this->integerMax15 = $integerMax15;
		
		return $this;
	}

	/**
	 * Get integerMax15
	 *
	 * @return integer
	 */
	public function getIntegerMax15() {
		return $this->integerMax15;
	}

	/**
	 * Set integerMax16
	 *
	 * @param integer $integerMax16        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax16($integerMax16) {
		$this->integerMax16 = $integerMax16;
		
		return $this;
	}

	/**
	 * Get integerMax16
	 *
	 * @return integer
	 */
	public function getIntegerMax16() {
		return $this->integerMax16;
	}

	/**
	 * Set integerMax17
	 *
	 * @param integer $integerMax17        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax17($integerMax17) {
		$this->integerMax17 = $integerMax17;
		
		return $this;
	}

	/**
	 * Get integerMax17
	 *
	 * @return integer
	 */
	public function getIntegerMax17() {
		return $this->integerMax17;
	}

	/**
	 * Set integerMax18
	 *
	 * @param integer $integerMax18        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax18($integerMax18) {
		$this->integerMax18 = $integerMax18;
		
		return $this;
	}

	/**
	 * Get integerMax18
	 *
	 * @return integer
	 */
	public function getIntegerMax18() {
		return $this->integerMax18;
	}

	/**
	 * Set integerMax19
	 *
	 * @param integer $integerMax19        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax19($integerMax19) {
		$this->integerMax19 = $integerMax19;
		
		return $this;
	}

	/**
	 * Get integerMax19
	 *
	 * @return integer
	 */
	public function getIntegerMax19() {
		return $this->integerMax19;
	}

	/**
	 * Set integerMax20
	 *
	 * @param integer $integerMax20        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax20($integerMax20) {
		$this->integerMax20 = $integerMax20;
		
		return $this;
	}

	/**
	 * Get integerMax20
	 *
	 * @return integer
	 */
	public function getIntegerMax20() {
		return $this->integerMax20;
	}

	/**
	 * Set integerMax21
	 *
	 * @param integer $integerMax21        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax21($integerMax21) {
		$this->integerMax21 = $integerMax21;
		
		return $this;
	}

	/**
	 * Get integerMax21
	 *
	 * @return integer
	 */
	public function getIntegerMax21() {
		return $this->integerMax21;
	}

	/**
	 * Set integerMax22
	 *
	 * @param integer $integerMax22        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax22($integerMax22) {
		$this->integerMax22 = $integerMax22;
		
		return $this;
	}

	/**
	 * Get integerMax22
	 *
	 * @return integer
	 */
	public function getIntegerMax22() {
		return $this->integerMax22;
	}

	/**
	 * Set integerMax23
	 *
	 * @param integer $integerMax23        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax23($integerMax23) {
		$this->integerMax23 = $integerMax23;
		
		return $this;
	}

	/**
	 * Get integerMax23
	 *
	 * @return integer
	 */
	public function getIntegerMax23() {
		return $this->integerMax23;
	}

	/**
	 * Set integerMax24
	 *
	 * @param integer $integerMax24        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax24($integerMax24) {
		$this->integerMax24 = $integerMax24;
		
		return $this;
	}

	/**
	 * Get integerMax24
	 *
	 * @return integer
	 */
	public function getIntegerMax24() {
		return $this->integerMax24;
	}

	/**
	 * Set integerMax25
	 *
	 * @param integer $integerMax25        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax25($integerMax25) {
		$this->integerMax25 = $integerMax25;
		
		return $this;
	}

	/**
	 * Get integerMax25
	 *
	 * @return integer
	 */
	public function getIntegerMax25() {
		return $this->integerMax25;
	}

	/**
	 * Set integerMax26
	 *
	 * @param integer $integerMax26        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax26($integerMax26) {
		$this->integerMax26 = $integerMax26;
		
		return $this;
	}

	/**
	 * Get integerMax26
	 *
	 * @return integer
	 */
	public function getIntegerMax26() {
		return $this->integerMax26;
	}

	/**
	 * Set integerMax27
	 *
	 * @param integer $integerMax27        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax27($integerMax27) {
		$this->integerMax27 = $integerMax27;
		
		return $this;
	}

	/**
	 * Get integerMax27
	 *
	 * @return integer
	 */
	public function getIntegerMax27() {
		return $this->integerMax27;
	}

	/**
	 * Set integerMax28
	 *
	 * @param integer $integerMax28        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax28($integerMax28) {
		$this->integerMax28 = $integerMax28;
		
		return $this;
	}

	/**
	 * Get integerMax28
	 *
	 * @return integer
	 */
	public function getIntegerMax28() {
		return $this->integerMax28;
	}

	/**
	 * Set integerMax29
	 *
	 * @param integer $integerMax29        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax29($integerMax29) {
		$this->integerMax29 = $integerMax29;
		
		return $this;
	}

	/**
	 * Get integerMax29
	 *
	 * @return integer
	 */
	public function getIntegerMax29() {
		return $this->integerMax29;
	}

	/**
	 * Set integerMax30
	 *
	 * @param integer $integerMax30        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMax30($integerMax30) {
		$this->integerMax30 = $integerMax30;
		
		return $this;
	}

	/**
	 * Get integerMax30
	 *
	 * @return integer
	 */
	public function getIntegerMax30() {
		return $this->integerMax30;
	}

	/**
	 * Set integerMedian1
	 *
	 * @param integer $integerMedian1        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian1($integerMedian1) {
		$this->integerMedian1 = $integerMedian1;
		
		return $this;
	}

	/**
	 * Get integerMedian1
	 *
	 * @return integer
	 */
	public function getIntegerMedian1() {
		return $this->integerMedian1;
	}

	/**
	 * Set integerMedian2
	 *
	 * @param integer $integerMedian2        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian2($integerMedian2) {
		$this->integerMedian2 = $integerMedian2;
		
		return $this;
	}

	/**
	 * Get integerMedian2
	 *
	 * @return integer
	 */
	public function getIntegerMedian2() {
		return $this->integerMedian2;
	}

	/**
	 * Set integerMedian3
	 *
	 * @param integer $integerMedian3        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian3($integerMedian3) {
		$this->integerMedian3 = $integerMedian3;
		
		return $this;
	}

	/**
	 * Get integerMedian3
	 *
	 * @return integer
	 */
	public function getIntegerMedian3() {
		return $this->integerMedian3;
	}

	/**
	 * Set integerMedian4
	 *
	 * @param integer $integerMedian4        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian4($integerMedian4) {
		$this->integerMedian4 = $integerMedian4;
		
		return $this;
	}

	/**
	 * Get integerMedian4
	 *
	 * @return integer
	 */
	public function getIntegerMedian4() {
		return $this->integerMedian4;
	}

	/**
	 * Set integerMedian5
	 *
	 * @param integer $integerMedian5        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian5($integerMedian5) {
		$this->integerMedian5 = $integerMedian5;
		
		return $this;
	}

	/**
	 * Get integerMedian5
	 *
	 * @return integer
	 */
	public function getIntegerMedian5() {
		return $this->integerMedian5;
	}

	/**
	 * Set integerMedian6
	 *
	 * @param integer $integerMedian6        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian6($integerMedian6) {
		$this->integerMedian6 = $integerMedian6;
		
		return $this;
	}

	/**
	 * Get integerMedian6
	 *
	 * @return integer
	 */
	public function getIntegerMedian6() {
		return $this->integerMedian6;
	}

	/**
	 * Set integerMedian7
	 *
	 * @param integer $integerMedian7        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian7($integerMedian7) {
		$this->integerMedian7 = $integerMedian7;
		
		return $this;
	}

	/**
	 * Get integerMedian7
	 *
	 * @return integer
	 */
	public function getIntegerMedian7() {
		return $this->integerMedian7;
	}

	/**
	 * Set integerMedian8
	 *
	 * @param integer $integerMedian8        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian8($integerMedian8) {
		$this->integerMedian8 = $integerMedian8;
		
		return $this;
	}

	/**
	 * Get integerMedian8
	 *
	 * @return integer
	 */
	public function getIntegerMedian8() {
		return $this->integerMedian8;
	}

	/**
	 * Set integerMedian9
	 *
	 * @param integer $integerMedian9        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian9($integerMedian9) {
		$this->integerMedian9 = $integerMedian9;
		
		return $this;
	}

	/**
	 * Get integerMedian9
	 *
	 * @return integer
	 */
	public function getIntegerMedian9() {
		return $this->integerMedian9;
	}

	/**
	 * Set integerMedian10
	 *
	 * @param integer $integerMedian10        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian10($integerMedian10) {
		$this->integerMedian10 = $integerMedian10;
		
		return $this;
	}

	/**
	 * Get integerMedian10
	 *
	 * @return integer
	 */
	public function getIntegerMedian10() {
		return $this->integerMedian10;
	}

	/**
	 * Set integerMedian11
	 *
	 * @param integer $integerMedian11        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian11($integerMedian11) {
		$this->integerMedian11 = $integerMedian11;
		
		return $this;
	}

	/**
	 * Get integerMedian11
	 *
	 * @return integer
	 */
	public function getIntegerMedian11() {
		return $this->integerMedian11;
	}

	/**
	 * Set integerMedian12
	 *
	 * @param integer $integerMedian12        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian12($integerMedian12) {
		$this->integerMedian12 = $integerMedian12;
		
		return $this;
	}

	/**
	 * Get integerMedian12
	 *
	 * @return integer
	 */
	public function getIntegerMedian12() {
		return $this->integerMedian12;
	}

	/**
	 * Set integerMedian13
	 *
	 * @param integer $integerMedian13        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian13($integerMedian13) {
		$this->integerMedian13 = $integerMedian13;
		
		return $this;
	}

	/**
	 * Get integerMedian13
	 *
	 * @return integer
	 */
	public function getIntegerMedian13() {
		return $this->integerMedian13;
	}

	/**
	 * Set integerMedian14
	 *
	 * @param integer $integerMedian14        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian14($integerMedian14) {
		$this->integerMedian14 = $integerMedian14;
		
		return $this;
	}

	/**
	 * Get integerMedian14
	 *
	 * @return integer
	 */
	public function getIntegerMedian14() {
		return $this->integerMedian14;
	}

	/**
	 * Set integerMedian15
	 *
	 * @param integer $integerMedian15        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian15($integerMedian15) {
		$this->integerMedian15 = $integerMedian15;
		
		return $this;
	}

	/**
	 * Get integerMedian15
	 *
	 * @return integer
	 */
	public function getIntegerMedian15() {
		return $this->integerMedian15;
	}

	/**
	 * Set integerMedian16
	 *
	 * @param integer $integerMedian16        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian16($integerMedian16) {
		$this->integerMedian16 = $integerMedian16;
		
		return $this;
	}

	/**
	 * Get integerMedian16
	 *
	 * @return integer
	 */
	public function getIntegerMedian16() {
		return $this->integerMedian16;
	}

	/**
	 * Set integerMedian17
	 *
	 * @param integer $integerMedian17        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian17($integerMedian17) {
		$this->integerMedian17 = $integerMedian17;
		
		return $this;
	}

	/**
	 * Get integerMedian17
	 *
	 * @return integer
	 */
	public function getIntegerMedian17() {
		return $this->integerMedian17;
	}

	/**
	 * Set integerMedian18
	 *
	 * @param integer $integerMedian18        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian18($integerMedian18) {
		$this->integerMedian18 = $integerMedian18;
		
		return $this;
	}

	/**
	 * Get integerMedian18
	 *
	 * @return integer
	 */
	public function getIntegerMedian18() {
		return $this->integerMedian18;
	}

	/**
	 * Set integerMedian19
	 *
	 * @param integer $integerMedian19        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian19($integerMedian19) {
		$this->integerMedian19 = $integerMedian19;
		
		return $this;
	}

	/**
	 * Get integerMedian19
	 *
	 * @return integer
	 */
	public function getIntegerMedian19() {
		return $this->integerMedian19;
	}

	/**
	 * Set integerMedian20
	 *
	 * @param integer $integerMedian20        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian20($integerMedian20) {
		$this->integerMedian20 = $integerMedian20;
		
		return $this;
	}

	/**
	 * Get integerMedian20
	 *
	 * @return integer
	 */
	public function getIntegerMedian20() {
		return $this->integerMedian20;
	}

	/**
	 * Set integerMedian21
	 *
	 * @param integer $integerMedian21        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian21($integerMedian21) {
		$this->integerMedian21 = $integerMedian21;
		
		return $this;
	}

	/**
	 * Get integerMedian21
	 *
	 * @return integer
	 */
	public function getIntegerMedian21() {
		return $this->integerMedian21;
	}

	/**
	 * Set integerMedian22
	 *
	 * @param integer $integerMedian22        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian22($integerMedian22) {
		$this->integerMedian22 = $integerMedian22;
		
		return $this;
	}

	/**
	 * Get integerMedian22
	 *
	 * @return integer
	 */
	public function getIntegerMedian22() {
		return $this->integerMedian22;
	}

	/**
	 * Set integerMedian23
	 *
	 * @param integer $integerMedian23        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian23($integerMedian23) {
		$this->integerMedian23 = $integerMedian23;
		
		return $this;
	}

	/**
	 * Get integerMedian23
	 *
	 * @return integer
	 */
	public function getIntegerMedian23() {
		return $this->integerMedian23;
	}

	/**
	 * Set integerMedian24
	 *
	 * @param integer $integerMedian24        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian24($integerMedian24) {
		$this->integerMedian24 = $integerMedian24;
		
		return $this;
	}

	/**
	 * Get integerMedian24
	 *
	 * @return integer
	 */
	public function getIntegerMedian24() {
		return $this->integerMedian24;
	}

	/**
	 * Set integerMedian25
	 *
	 * @param integer $integerMedian25        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian25($integerMedian25) {
		$this->integerMedian25 = $integerMedian25;
		
		return $this;
	}

	/**
	 * Get integerMedian25
	 *
	 * @return integer
	 */
	public function getIntegerMedian25() {
		return $this->integerMedian25;
	}

	/**
	 * Set integerMedian26
	 *
	 * @param integer $integerMedian26        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian26($integerMedian26) {
		$this->integerMedian26 = $integerMedian26;
		
		return $this;
	}

	/**
	 * Get integerMedian26
	 *
	 * @return integer
	 */
	public function getIntegerMedian26() {
		return $this->integerMedian26;
	}

	/**
	 * Set integerMedian27
	 *
	 * @param integer $integerMedian27        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian27($integerMedian27) {
		$this->integerMedian27 = $integerMedian27;
		
		return $this;
	}

	/**
	 * Get integerMedian27
	 *
	 * @return integer
	 */
	public function getIntegerMedian27() {
		return $this->integerMedian27;
	}

	/**
	 * Set integerMedian28
	 *
	 * @param integer $integerMedian28        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian28($integerMedian28) {
		$this->integerMedian28 = $integerMedian28;
		
		return $this;
	}

	/**
	 * Get integerMedian28
	 *
	 * @return integer
	 */
	public function getIntegerMedian28() {
		return $this->integerMedian28;
	}

	/**
	 * Set integerMedian29
	 *
	 * @param integer $integerMedian29        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian29($integerMedian29) {
		$this->integerMedian29 = $integerMedian29;
		
		return $this;
	}

	/**
	 * Get integerMedian29
	 *
	 * @return integer
	 */
	public function getIntegerMedian29() {
		return $this->integerMedian29;
	}

	/**
	 * Set integerMedian30
	 *
	 * @param integer $integerMedian30        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMedian30($integerMedian30) {
		$this->integerMedian30 = $integerMedian30;
		
		return $this;
	}

	/**
	 * Get integerMedian30
	 *
	 * @return integer
	 */
	public function getIntegerMedian30() {
		return $this->integerMedian30;
	}

	/**
	 * Set integerMode1
	 *
	 * @param integer $integerMode1        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode1($integerMode1) {
		$this->integerMode1 = $integerMode1;
		
		return $this;
	}

	/**
	 * Get integerMode1
	 *
	 * @return integer
	 */
	public function getIntegerMode1() {
		return $this->integerMode1;
	}

	/**
	 * Set integerMode2
	 *
	 * @param integer $integerMode2        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode2($integerMode2) {
		$this->integerMode2 = $integerMode2;
		
		return $this;
	}

	/**
	 * Get integerMode2
	 *
	 * @return integer
	 */
	public function getIntegerMode2() {
		return $this->integerMode2;
	}

	/**
	 * Set integerMode3
	 *
	 * @param integer $integerMode3        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode3($integerMode3) {
		$this->integerMode3 = $integerMode3;
		
		return $this;
	}

	/**
	 * Get integerMode3
	 *
	 * @return integer
	 */
	public function getIntegerMode3() {
		return $this->integerMode3;
	}

	/**
	 * Set integerMode4
	 *
	 * @param integer $integerMode4        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode4($integerMode4) {
		$this->integerMode4 = $integerMode4;
		
		return $this;
	}

	/**
	 * Get integerMode4
	 *
	 * @return integer
	 */
	public function getIntegerMode4() {
		return $this->integerMode4;
	}

	/**
	 * Set integerMode5
	 *
	 * @param integer $integerMode5        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode5($integerMode5) {
		$this->integerMode5 = $integerMode5;
		
		return $this;
	}

	/**
	 * Get integerMode5
	 *
	 * @return integer
	 */
	public function getIntegerMode5() {
		return $this->integerMode5;
	}

	/**
	 * Set integerMode6
	 *
	 * @param integer $integerMode6        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode6($integerMode6) {
		$this->integerMode6 = $integerMode6;
		
		return $this;
	}

	/**
	 * Get integerMode6
	 *
	 * @return integer
	 */
	public function getIntegerMode6() {
		return $this->integerMode6;
	}

	/**
	 * Set integerMode7
	 *
	 * @param integer $integerMode7        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode7($integerMode7) {
		$this->integerMode7 = $integerMode7;
		
		return $this;
	}

	/**
	 * Get integerMode7
	 *
	 * @return integer
	 */
	public function getIntegerMode7() {
		return $this->integerMode7;
	}

	/**
	 * Set integerMode8
	 *
	 * @param integer $integerMode8        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode8($integerMode8) {
		$this->integerMode8 = $integerMode8;
		
		return $this;
	}

	/**
	 * Get integerMode8
	 *
	 * @return integer
	 */
	public function getIntegerMode8() {
		return $this->integerMode8;
	}

	/**
	 * Set integerMode9
	 *
	 * @param integer $integerMode9        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode9($integerMode9) {
		$this->integerMode9 = $integerMode9;
		
		return $this;
	}

	/**
	 * Get integerMode9
	 *
	 * @return integer
	 */
	public function getIntegerMode9() {
		return $this->integerMode9;
	}

	/**
	 * Set integerMode10
	 *
	 * @param integer $integerMode10        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode10($integerMode10) {
		$this->integerMode10 = $integerMode10;
		
		return $this;
	}

	/**
	 * Get integerMode10
	 *
	 * @return integer
	 */
	public function getIntegerMode10() {
		return $this->integerMode10;
	}

	/**
	 * Set integerMode11
	 *
	 * @param integer $integerMode11        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode11($integerMode11) {
		$this->integerMode11 = $integerMode11;
		
		return $this;
	}

	/**
	 * Get integerMode11
	 *
	 * @return integer
	 */
	public function getIntegerMode11() {
		return $this->integerMode11;
	}

	/**
	 * Set integerMode12
	 *
	 * @param integer $integerMode12        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode12($integerMode12) {
		$this->integerMode12 = $integerMode12;
		
		return $this;
	}

	/**
	 * Get integerMode12
	 *
	 * @return integer
	 */
	public function getIntegerMode12() {
		return $this->integerMode12;
	}

	/**
	 * Set integerMode13
	 *
	 * @param integer $integerMode13        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode13($integerMode13) {
		$this->integerMode13 = $integerMode13;
		
		return $this;
	}

	/**
	 * Get integerMode13
	 *
	 * @return integer
	 */
	public function getIntegerMode13() {
		return $this->integerMode13;
	}

	/**
	 * Set integerMode14
	 *
	 * @param integer $integerMode14        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode14($integerMode14) {
		$this->integerMode14 = $integerMode14;
		
		return $this;
	}

	/**
	 * Get integerMode14
	 *
	 * @return integer
	 */
	public function getIntegerMode14() {
		return $this->integerMode14;
	}

	/**
	 * Set integerMode15
	 *
	 * @param integer $integerMode15        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode15($integerMode15) {
		$this->integerMode15 = $integerMode15;
		
		return $this;
	}

	/**
	 * Get integerMode15
	 *
	 * @return integer
	 */
	public function getIntegerMode15() {
		return $this->integerMode15;
	}

	/**
	 * Set integerMode16
	 *
	 * @param integer $integerMode16        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode16($integerMode16) {
		$this->integerMode16 = $integerMode16;
		
		return $this;
	}

	/**
	 * Get integerMode16
	 *
	 * @return integer
	 */
	public function getIntegerMode16() {
		return $this->integerMode16;
	}

	/**
	 * Set integerMode17
	 *
	 * @param integer $integerMode17        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode17($integerMode17) {
		$this->integerMode17 = $integerMode17;
		
		return $this;
	}

	/**
	 * Get integerMode17
	 *
	 * @return integer
	 */
	public function getIntegerMode17() {
		return $this->integerMode17;
	}

	/**
	 * Set integerMode18
	 *
	 * @param integer $integerMode18        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode18($integerMode18) {
		$this->integerMode18 = $integerMode18;
		
		return $this;
	}

	/**
	 * Get integerMode18
	 *
	 * @return integer
	 */
	public function getIntegerMode18() {
		return $this->integerMode18;
	}

	/**
	 * Set integerMode19
	 *
	 * @param integer $integerMode19        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode19($integerMode19) {
		$this->integerMode19 = $integerMode19;
		
		return $this;
	}

	/**
	 * Get integerMode19
	 *
	 * @return integer
	 */
	public function getIntegerMode19() {
		return $this->integerMode19;
	}

	/**
	 * Set integerMode20
	 *
	 * @param integer $integerMode20        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode20($integerMode20) {
		$this->integerMode20 = $integerMode20;
		
		return $this;
	}

	/**
	 * Get integerMode20
	 *
	 * @return integer
	 */
	public function getIntegerMode20() {
		return $this->integerMode20;
	}

	/**
	 * Set integerMode21
	 *
	 * @param integer $integerMode21        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode21($integerMode21) {
		$this->integerMode21 = $integerMode21;
		
		return $this;
	}

	/**
	 * Get integerMode21
	 *
	 * @return integer
	 */
	public function getIntegerMode21() {
		return $this->integerMode21;
	}

	/**
	 * Set integerMode22
	 *
	 * @param integer $integerMode22        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode22($integerMode22) {
		$this->integerMode22 = $integerMode22;
		
		return $this;
	}

	/**
	 * Get integerMode22
	 *
	 * @return integer
	 */
	public function getIntegerMode22() {
		return $this->integerMode22;
	}

	/**
	 * Set integerMode23
	 *
	 * @param integer $integerMode23        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode23($integerMode23) {
		$this->integerMode23 = $integerMode23;
		
		return $this;
	}

	/**
	 * Get integerMode23
	 *
	 * @return integer
	 */
	public function getIntegerMode23() {
		return $this->integerMode23;
	}

	/**
	 * Set integerMode24
	 *
	 * @param integer $integerMode24        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode24($integerMode24) {
		$this->integerMode24 = $integerMode24;
		
		return $this;
	}

	/**
	 * Get integerMode24
	 *
	 * @return integer
	 */
	public function getIntegerMode24() {
		return $this->integerMode24;
	}

	/**
	 * Set integerMode25
	 *
	 * @param integer $integerMode25        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode25($integerMode25) {
		$this->integerMode25 = $integerMode25;
		
		return $this;
	}

	/**
	 * Get integerMode25
	 *
	 * @return integer
	 */
	public function getIntegerMode25() {
		return $this->integerMode25;
	}

	/**
	 * Set integerMode26
	 *
	 * @param integer $integerMode26        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode26($integerMode26) {
		$this->integerMode26 = $integerMode26;
		
		return $this;
	}

	/**
	 * Get integerMode26
	 *
	 * @return integer
	 */
	public function getIntegerMode26() {
		return $this->integerMode26;
	}

	/**
	 * Set integerMode27
	 *
	 * @param integer $integerMode27        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode27($integerMode27) {
		$this->integerMode27 = $integerMode27;
		
		return $this;
	}

	/**
	 * Get integerMode27
	 *
	 * @return integer
	 */
	public function getIntegerMode27() {
		return $this->integerMode27;
	}

	/**
	 * Set integerMode28
	 *
	 * @param integer $integerMode28        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode28($integerMode28) {
		$this->integerMode28 = $integerMode28;
		
		return $this;
	}

	/**
	 * Get integerMode28
	 *
	 * @return integer
	 */
	public function getIntegerMode28() {
		return $this->integerMode28;
	}

	/**
	 * Set integerMode29
	 *
	 * @param integer $integerMode29        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode29($integerMode29) {
		$this->integerMode29 = $integerMode29;
		
		return $this;
	}

	/**
	 * Get integerMode29
	 *
	 * @return integer
	 */
	public function getIntegerMode29() {
		return $this->integerMode29;
	}

	/**
	 * Set integerMode30
	 *
	 * @param integer $integerMode30        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMode30($integerMode30) {
		$this->integerMode30 = $integerMode30;
		
		return $this;
	}

	/**
	 * Get integerMode30
	 *
	 * @return integer
	 */
	public function getIntegerMode30() {
		return $this->integerMode30;
	}

	/**
	 * Set integerMean1
	 *
	 * @param string $integerMean1        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean1($integerMean1) {
		$this->integerMean1 = $integerMean1;
		
		return $this;
	}

	/**
	 * Get integerMean1
	 *
	 * @return string
	 */
	public function getIntegerMean1() {
		return $this->integerMean1;
	}

	/**
	 * Set integerMean2
	 *
	 * @param string $integerMean2        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean2($integerMean2) {
		$this->integerMean2 = $integerMean2;
		
		return $this;
	}

	/**
	 * Get integerMean2
	 *
	 * @return string
	 */
	public function getIntegerMean2() {
		return $this->integerMean2;
	}

	/**
	 * Set integerMean3
	 *
	 * @param string $integerMean3        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean3($integerMean3) {
		$this->integerMean3 = $integerMean3;
		
		return $this;
	}

	/**
	 * Get integerMean3
	 *
	 * @return string
	 */
	public function getIntegerMean3() {
		return $this->integerMean3;
	}

	/**
	 * Set integerMean4
	 *
	 * @param string $integerMean4        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean4($integerMean4) {
		$this->integerMean4 = $integerMean4;
		
		return $this;
	}

	/**
	 * Get integerMean4
	 *
	 * @return string
	 */
	public function getIntegerMean4() {
		return $this->integerMean4;
	}

	/**
	 * Set integerMean5
	 *
	 * @param string $integerMean5        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean5($integerMean5) {
		$this->integerMean5 = $integerMean5;
		
		return $this;
	}

	/**
	 * Get integerMean5
	 *
	 * @return string
	 */
	public function getIntegerMean5() {
		return $this->integerMean5;
	}

	/**
	 * Set integerMean6
	 *
	 * @param string $integerMean6        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean6($integerMean6) {
		$this->integerMean6 = $integerMean6;
		
		return $this;
	}

	/**
	 * Get integerMean6
	 *
	 * @return string
	 */
	public function getIntegerMean6() {
		return $this->integerMean6;
	}

	/**
	 * Set integerMean7
	 *
	 * @param string $integerMean7        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean7($integerMean7) {
		$this->integerMean7 = $integerMean7;
		
		return $this;
	}

	/**
	 * Get integerMean7
	 *
	 * @return string
	 */
	public function getIntegerMean7() {
		return $this->integerMean7;
	}

	/**
	 * Set integerMean8
	 *
	 * @param string $integerMean8        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean8($integerMean8) {
		$this->integerMean8 = $integerMean8;
		
		return $this;
	}

	/**
	 * Get integerMean8
	 *
	 * @return string
	 */
	public function getIntegerMean8() {
		return $this->integerMean8;
	}

	/**
	 * Set integerMean9
	 *
	 * @param string $integerMean9        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean9($integerMean9) {
		$this->integerMean9 = $integerMean9;
		
		return $this;
	}

	/**
	 * Get integerMean9
	 *
	 * @return string
	 */
	public function getIntegerMean9() {
		return $this->integerMean9;
	}

	/**
	 * Set integerMean10
	 *
	 * @param string $integerMean10        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean10($integerMean10) {
		$this->integerMean10 = $integerMean10;
		
		return $this;
	}

	/**
	 * Get integerMean10
	 *
	 * @return string
	 */
	public function getIntegerMean10() {
		return $this->integerMean10;
	}

	/**
	 * Set integerMean11
	 *
	 * @param string $integerMean11        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean11($integerMean11) {
		$this->integerMean11 = $integerMean11;
		
		return $this;
	}

	/**
	 * Get integerMean11
	 *
	 * @return string
	 */
	public function getIntegerMean11() {
		return $this->integerMean11;
	}

	/**
	 * Set integerMean12
	 *
	 * @param string $integerMean12        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean12($integerMean12) {
		$this->integerMean12 = $integerMean12;
		
		return $this;
	}

	/**
	 * Get integerMean12
	 *
	 * @return string
	 */
	public function getIntegerMean12() {
		return $this->integerMean12;
	}

	/**
	 * Set integerMean13
	 *
	 * @param string $integerMean13        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean13($integerMean13) {
		$this->integerMean13 = $integerMean13;
		
		return $this;
	}

	/**
	 * Get integerMean13
	 *
	 * @return string
	 */
	public function getIntegerMean13() {
		return $this->integerMean13;
	}

	/**
	 * Set integerMean14
	 *
	 * @param string $integerMean14        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean14($integerMean14) {
		$this->integerMean14 = $integerMean14;
		
		return $this;
	}

	/**
	 * Get integerMean14
	 *
	 * @return string
	 */
	public function getIntegerMean14() {
		return $this->integerMean14;
	}

	/**
	 * Set integerMean15
	 *
	 * @param string $integerMean15        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean15($integerMean15) {
		$this->integerMean15 = $integerMean15;
		
		return $this;
	}

	/**
	 * Get integerMean15
	 *
	 * @return string
	 */
	public function getIntegerMean15() {
		return $this->integerMean15;
	}

	/**
	 * Set integerMean16
	 *
	 * @param string $integerMean16        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean16($integerMean16) {
		$this->integerMean16 = $integerMean16;
		
		return $this;
	}

	/**
	 * Get integerMean16
	 *
	 * @return string
	 */
	public function getIntegerMean16() {
		return $this->integerMean16;
	}

	/**
	 * Set integerMean17
	 *
	 * @param string $integerMean17        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean17($integerMean17) {
		$this->integerMean17 = $integerMean17;
		
		return $this;
	}

	/**
	 * Get integerMean17
	 *
	 * @return string
	 */
	public function getIntegerMean17() {
		return $this->integerMean17;
	}

	/**
	 * Set integerMean18
	 *
	 * @param string $integerMean18        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean18($integerMean18) {
		$this->integerMean18 = $integerMean18;
		
		return $this;
	}

	/**
	 * Get integerMean18
	 *
	 * @return string
	 */
	public function getIntegerMean18() {
		return $this->integerMean18;
	}

	/**
	 * Set integerMean19
	 *
	 * @param string $integerMean19        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean19($integerMean19) {
		$this->integerMean19 = $integerMean19;
		
		return $this;
	}

	/**
	 * Get integerMean19
	 *
	 * @return string
	 */
	public function getIntegerMean19() {
		return $this->integerMean19;
	}

	/**
	 * Set integerMean20
	 *
	 * @param string $integerMean20        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean20($integerMean20) {
		$this->integerMean20 = $integerMean20;
		
		return $this;
	}

	/**
	 * Get integerMean20
	 *
	 * @return string
	 */
	public function getIntegerMean20() {
		return $this->integerMean20;
	}

	/**
	 * Set integerMean21
	 *
	 * @param string $integerMean21        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean21($integerMean21) {
		$this->integerMean21 = $integerMean21;
		
		return $this;
	}

	/**
	 * Get integerMean21
	 *
	 * @return string
	 */
	public function getIntegerMean21() {
		return $this->integerMean21;
	}

	/**
	 * Set integerMean22
	 *
	 * @param string $integerMean22        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean22($integerMean22) {
		$this->integerMean22 = $integerMean22;
		
		return $this;
	}

	/**
	 * Get integerMean22
	 *
	 * @return string
	 */
	public function getIntegerMean22() {
		return $this->integerMean22;
	}

	/**
	 * Set integerMean23
	 *
	 * @param string $integerMean23        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean23($integerMean23) {
		$this->integerMean23 = $integerMean23;
		
		return $this;
	}

	/**
	 * Get integerMean23
	 *
	 * @return string
	 */
	public function getIntegerMean23() {
		return $this->integerMean23;
	}

	/**
	 * Set integerMean24
	 *
	 * @param string $integerMean24        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean24($integerMean24) {
		$this->integerMean24 = $integerMean24;
		
		return $this;
	}

	/**
	 * Get integerMean24
	 *
	 * @return string
	 */
	public function getIntegerMean24() {
		return $this->integerMean24;
	}

	/**
	 * Set integerMean25
	 *
	 * @param string $integerMean25        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean25($integerMean25) {
		$this->integerMean25 = $integerMean25;
		
		return $this;
	}

	/**
	 * Get integerMean25
	 *
	 * @return string
	 */
	public function getIntegerMean25() {
		return $this->integerMean25;
	}

	/**
	 * Set integerMean26
	 *
	 * @param string $integerMean26        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean26($integerMean26) {
		$this->integerMean26 = $integerMean26;
		
		return $this;
	}

	/**
	 * Get integerMean26
	 *
	 * @return string
	 */
	public function getIntegerMean26() {
		return $this->integerMean26;
	}

	/**
	 * Set integerMean27
	 *
	 * @param string $integerMean27        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean27($integerMean27) {
		$this->integerMean27 = $integerMean27;
		
		return $this;
	}

	/**
	 * Get integerMean27
	 *
	 * @return string
	 */
	public function getIntegerMean27() {
		return $this->integerMean27;
	}

	/**
	 * Set integerMean28
	 *
	 * @param string $integerMean28        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean28($integerMean28) {
		$this->integerMean28 = $integerMean28;
		
		return $this;
	}

	/**
	 * Get integerMean28
	 *
	 * @return string
	 */
	public function getIntegerMean28() {
		return $this->integerMean28;
	}

	/**
	 * Set integerMean29
	 *
	 * @param string $integerMean29        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean29($integerMean29) {
		$this->integerMean29 = $integerMean29;
		
		return $this;
	}

	/**
	 * Get integerMean29
	 *
	 * @return string
	 */
	public function getIntegerMean29() {
		return $this->integerMean29;
	}

	/**
	 * Set integerMean30
	 *
	 * @param string $integerMean30        	
	 *
	 * @return CategorySummary
	 */
	public function setIntegerMean30($integerMean30) {
		$this->integerMean30 = $integerMean30;
		
		return $this;
	}

	/**
	 * Get integerMean30
	 *
	 * @return string
	 */
	public function getIntegerMean30() {
		return $this->integerMean30;
	}

	/**
	 * Set stringMin1
	 *
	 * @param integer $stringMin1        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin1($stringMin1) {
		$this->stringMin1 = $stringMin1;
		
		return $this;
	}

	/**
	 * Get stringMin1
	 *
	 * @return integer
	 */
	public function getStringMin1() {
		return $this->stringMin1;
	}

	/**
	 * Set stringMin2
	 *
	 * @param integer $stringMin2        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin2($stringMin2) {
		$this->stringMin2 = $stringMin2;
		
		return $this;
	}

	/**
	 * Get stringMin2
	 *
	 * @return integer
	 */
	public function getStringMin2() {
		return $this->stringMin2;
	}

	/**
	 * Set stringMin3
	 *
	 * @param integer $stringMin3        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin3($stringMin3) {
		$this->stringMin3 = $stringMin3;
		
		return $this;
	}

	/**
	 * Get stringMin3
	 *
	 * @return integer
	 */
	public function getStringMin3() {
		return $this->stringMin3;
	}

	/**
	 * Set stringMin4
	 *
	 * @param integer $stringMin4        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin4($stringMin4) {
		$this->stringMin4 = $stringMin4;
		
		return $this;
	}

	/**
	 * Get stringMin4
	 *
	 * @return integer
	 */
	public function getStringMin4() {
		return $this->stringMin4;
	}

	/**
	 * Set stringMin5
	 *
	 * @param integer $stringMin5        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin5($stringMin5) {
		$this->stringMin5 = $stringMin5;
		
		return $this;
	}

	/**
	 * Get stringMin5
	 *
	 * @return integer
	 */
	public function getStringMin5() {
		return $this->stringMin5;
	}

	/**
	 * Set stringMin6
	 *
	 * @param integer $stringMin6        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin6($stringMin6) {
		$this->stringMin6 = $stringMin6;
		
		return $this;
	}

	/**
	 * Get stringMin6
	 *
	 * @return integer
	 */
	public function getStringMin6() {
		return $this->stringMin6;
	}

	/**
	 * Set stringMin7
	 *
	 * @param integer $stringMin7        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin7($stringMin7) {
		$this->stringMin7 = $stringMin7;
		
		return $this;
	}

	/**
	 * Get stringMin7
	 *
	 * @return integer
	 */
	public function getStringMin7() {
		return $this->stringMin7;
	}

	/**
	 * Set stringMin8
	 *
	 * @param integer $stringMin8        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin8($stringMin8) {
		$this->stringMin8 = $stringMin8;
		
		return $this;
	}

	/**
	 * Get stringMin8
	 *
	 * @return integer
	 */
	public function getStringMin8() {
		return $this->stringMin8;
	}

	/**
	 * Set stringMin9
	 *
	 * @param integer $stringMin9        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin9($stringMin9) {
		$this->stringMin9 = $stringMin9;
		
		return $this;
	}

	/**
	 * Get stringMin9
	 *
	 * @return integer
	 */
	public function getStringMin9() {
		return $this->stringMin9;
	}

	/**
	 * Set stringMin10
	 *
	 * @param integer $stringMin10        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin10($stringMin10) {
		$this->stringMin10 = $stringMin10;
		
		return $this;
	}

	/**
	 * Get stringMin10
	 *
	 * @return integer
	 */
	public function getStringMin10() {
		return $this->stringMin10;
	}

	/**
	 * Set stringMin11
	 *
	 * @param integer $stringMin11        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin11($stringMin11) {
		$this->stringMin11 = $stringMin11;
		
		return $this;
	}

	/**
	 * Get stringMin11
	 *
	 * @return integer
	 */
	public function getStringMin11() {
		return $this->stringMin11;
	}

	/**
	 * Set stringMin12
	 *
	 * @param integer $stringMin12        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin12($stringMin12) {
		$this->stringMin12 = $stringMin12;
		
		return $this;
	}

	/**
	 * Get stringMin12
	 *
	 * @return integer
	 */
	public function getStringMin12() {
		return $this->stringMin12;
	}

	/**
	 * Set stringMin13
	 *
	 * @param integer $stringMin13        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin13($stringMin13) {
		$this->stringMin13 = $stringMin13;
		
		return $this;
	}

	/**
	 * Get stringMin13
	 *
	 * @return integer
	 */
	public function getStringMin13() {
		return $this->stringMin13;
	}

	/**
	 * Set stringMin14
	 *
	 * @param integer $stringMin14        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin14($stringMin14) {
		$this->stringMin14 = $stringMin14;
		
		return $this;
	}

	/**
	 * Get stringMin14
	 *
	 * @return integer
	 */
	public function getStringMin14() {
		return $this->stringMin14;
	}

	/**
	 * Set stringMin15
	 *
	 * @param integer $stringMin15        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin15($stringMin15) {
		$this->stringMin15 = $stringMin15;
		
		return $this;
	}

	/**
	 * Get stringMin15
	 *
	 * @return integer
	 */
	public function getStringMin15() {
		return $this->stringMin15;
	}

	/**
	 * Set stringMin16
	 *
	 * @param integer $stringMin16        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin16($stringMin16) {
		$this->stringMin16 = $stringMin16;
		
		return $this;
	}

	/**
	 * Get stringMin16
	 *
	 * @return integer
	 */
	public function getStringMin16() {
		return $this->stringMin16;
	}

	/**
	 * Set stringMin17
	 *
	 * @param integer $stringMin17        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin17($stringMin17) {
		$this->stringMin17 = $stringMin17;
		
		return $this;
	}

	/**
	 * Get stringMin17
	 *
	 * @return integer
	 */
	public function getStringMin17() {
		return $this->stringMin17;
	}

	/**
	 * Set stringMin18
	 *
	 * @param integer $stringMin18        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin18($stringMin18) {
		$this->stringMin18 = $stringMin18;
		
		return $this;
	}

	/**
	 * Get stringMin18
	 *
	 * @return integer
	 */
	public function getStringMin18() {
		return $this->stringMin18;
	}

	/**
	 * Set stringMin19
	 *
	 * @param integer $stringMin19        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin19($stringMin19) {
		$this->stringMin19 = $stringMin19;
		
		return $this;
	}

	/**
	 * Get stringMin19
	 *
	 * @return integer
	 */
	public function getStringMin19() {
		return $this->stringMin19;
	}

	/**
	 * Set stringMin20
	 *
	 * @param integer $stringMin20        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin20($stringMin20) {
		$this->stringMin20 = $stringMin20;
		
		return $this;
	}

	/**
	 * Get stringMin20
	 *
	 * @return integer
	 */
	public function getStringMin20() {
		return $this->stringMin20;
	}

	/**
	 * Set stringMin21
	 *
	 * @param integer $stringMin21        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin21($stringMin21) {
		$this->stringMin21 = $stringMin21;
		
		return $this;
	}

	/**
	 * Get stringMin21
	 *
	 * @return integer
	 */
	public function getStringMin21() {
		return $this->stringMin21;
	}

	/**
	 * Set stringMin22
	 *
	 * @param integer $stringMin22        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin22($stringMin22) {
		$this->stringMin22 = $stringMin22;
		
		return $this;
	}

	/**
	 * Get stringMin22
	 *
	 * @return integer
	 */
	public function getStringMin22() {
		return $this->stringMin22;
	}

	/**
	 * Set stringMin23
	 *
	 * @param integer $stringMin23        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin23($stringMin23) {
		$this->stringMin23 = $stringMin23;
		
		return $this;
	}

	/**
	 * Get stringMin23
	 *
	 * @return integer
	 */
	public function getStringMin23() {
		return $this->stringMin23;
	}

	/**
	 * Set stringMin24
	 *
	 * @param integer $stringMin24        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin24($stringMin24) {
		$this->stringMin24 = $stringMin24;
		
		return $this;
	}

	/**
	 * Get stringMin24
	 *
	 * @return integer
	 */
	public function getStringMin24() {
		return $this->stringMin24;
	}

	/**
	 * Set stringMin25
	 *
	 * @param integer $stringMin25        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin25($stringMin25) {
		$this->stringMin25 = $stringMin25;
		
		return $this;
	}

	/**
	 * Get stringMin25
	 *
	 * @return integer
	 */
	public function getStringMin25() {
		return $this->stringMin25;
	}

	/**
	 * Set stringMin26
	 *
	 * @param integer $stringMin26        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin26($stringMin26) {
		$this->stringMin26 = $stringMin26;
		
		return $this;
	}

	/**
	 * Get stringMin26
	 *
	 * @return integer
	 */
	public function getStringMin26() {
		return $this->stringMin26;
	}

	/**
	 * Set stringMin27
	 *
	 * @param integer $stringMin27        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin27($stringMin27) {
		$this->stringMin27 = $stringMin27;
		
		return $this;
	}

	/**
	 * Get stringMin27
	 *
	 * @return integer
	 */
	public function getStringMin27() {
		return $this->stringMin27;
	}

	/**
	 * Set stringMin28
	 *
	 * @param integer $stringMin28        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin28($stringMin28) {
		$this->stringMin28 = $stringMin28;
		
		return $this;
	}

	/**
	 * Get stringMin28
	 *
	 * @return integer
	 */
	public function getStringMin28() {
		return $this->stringMin28;
	}

	/**
	 * Set stringMin29
	 *
	 * @param integer $stringMin29        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin29($stringMin29) {
		$this->stringMin29 = $stringMin29;
		
		return $this;
	}

	/**
	 * Get stringMin29
	 *
	 * @return integer
	 */
	public function getStringMin29() {
		return $this->stringMin29;
	}

	/**
	 * Set stringMin30
	 *
	 * @param integer $stringMin30        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMin30($stringMin30) {
		$this->stringMin30 = $stringMin30;
		
		return $this;
	}

	/**
	 * Get stringMin30
	 *
	 * @return integer
	 */
	public function getStringMin30() {
		return $this->stringMin30;
	}

	/**
	 * Set stringMax1
	 *
	 * @param integer $stringMax1        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax1($stringMax1) {
		$this->stringMax1 = $stringMax1;
		
		return $this;
	}

	/**
	 * Get stringMax1
	 *
	 * @return integer
	 */
	public function getStringMax1() {
		return $this->stringMax1;
	}

	/**
	 * Set stringMax2
	 *
	 * @param integer $stringMax2        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax2($stringMax2) {
		$this->stringMax2 = $stringMax2;
		
		return $this;
	}

	/**
	 * Get stringMax2
	 *
	 * @return integer
	 */
	public function getStringMax2() {
		return $this->stringMax2;
	}

	/**
	 * Set stringMax3
	 *
	 * @param integer $stringMax3        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax3($stringMax3) {
		$this->stringMax3 = $stringMax3;
		
		return $this;
	}

	/**
	 * Get stringMax3
	 *
	 * @return integer
	 */
	public function getStringMax3() {
		return $this->stringMax3;
	}

	/**
	 * Set stringMax4
	 *
	 * @param integer $stringMax4        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax4($stringMax4) {
		$this->stringMax4 = $stringMax4;
		
		return $this;
	}

	/**
	 * Get stringMax4
	 *
	 * @return integer
	 */
	public function getStringMax4() {
		return $this->stringMax4;
	}

	/**
	 * Set stringMax5
	 *
	 * @param integer $stringMax5        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax5($stringMax5) {
		$this->stringMax5 = $stringMax5;
		
		return $this;
	}

	/**
	 * Get stringMax5
	 *
	 * @return integer
	 */
	public function getStringMax5() {
		return $this->stringMax5;
	}

	/**
	 * Set stringMax6
	 *
	 * @param integer $stringMax6        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax6($stringMax6) {
		$this->stringMax6 = $stringMax6;
		
		return $this;
	}

	/**
	 * Get stringMax6
	 *
	 * @return integer
	 */
	public function getStringMax6() {
		return $this->stringMax6;
	}

	/**
	 * Set stringMax7
	 *
	 * @param integer $stringMax7        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax7($stringMax7) {
		$this->stringMax7 = $stringMax7;
		
		return $this;
	}

	/**
	 * Get stringMax7
	 *
	 * @return integer
	 */
	public function getStringMax7() {
		return $this->stringMax7;
	}

	/**
	 * Set stringMax8
	 *
	 * @param integer $stringMax8        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax8($stringMax8) {
		$this->stringMax8 = $stringMax8;
		
		return $this;
	}

	/**
	 * Get stringMax8
	 *
	 * @return integer
	 */
	public function getStringMax8() {
		return $this->stringMax8;
	}

	/**
	 * Set stringMax9
	 *
	 * @param integer $stringMax9        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax9($stringMax9) {
		$this->stringMax9 = $stringMax9;
		
		return $this;
	}

	/**
	 * Get stringMax9
	 *
	 * @return integer
	 */
	public function getStringMax9() {
		return $this->stringMax9;
	}

	/**
	 * Set stringMax10
	 *
	 * @param integer $stringMax10        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax10($stringMax10) {
		$this->stringMax10 = $stringMax10;
		
		return $this;
	}

	/**
	 * Get stringMax10
	 *
	 * @return integer
	 */
	public function getStringMax10() {
		return $this->stringMax10;
	}

	/**
	 * Set stringMax11
	 *
	 * @param integer $stringMax11        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax11($stringMax11) {
		$this->stringMax11 = $stringMax11;
		
		return $this;
	}

	/**
	 * Get stringMax11
	 *
	 * @return integer
	 */
	public function getStringMax11() {
		return $this->stringMax11;
	}

	/**
	 * Set stringMax12
	 *
	 * @param integer $stringMax12        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax12($stringMax12) {
		$this->stringMax12 = $stringMax12;
		
		return $this;
	}

	/**
	 * Get stringMax12
	 *
	 * @return integer
	 */
	public function getStringMax12() {
		return $this->stringMax12;
	}

	/**
	 * Set stringMax13
	 *
	 * @param integer $stringMax13        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax13($stringMax13) {
		$this->stringMax13 = $stringMax13;
		
		return $this;
	}

	/**
	 * Get stringMax13
	 *
	 * @return integer
	 */
	public function getStringMax13() {
		return $this->stringMax13;
	}

	/**
	 * Set stringMax14
	 *
	 * @param integer $stringMax14        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax14($stringMax14) {
		$this->stringMax14 = $stringMax14;
		
		return $this;
	}

	/**
	 * Get stringMax14
	 *
	 * @return integer
	 */
	public function getStringMax14() {
		return $this->stringMax14;
	}

	/**
	 * Set stringMax15
	 *
	 * @param integer $stringMax15        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax15($stringMax15) {
		$this->stringMax15 = $stringMax15;
		
		return $this;
	}

	/**
	 * Get stringMax15
	 *
	 * @return integer
	 */
	public function getStringMax15() {
		return $this->stringMax15;
	}

	/**
	 * Set stringMax16
	 *
	 * @param integer $stringMax16        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax16($stringMax16) {
		$this->stringMax16 = $stringMax16;
		
		return $this;
	}

	/**
	 * Get stringMax16
	 *
	 * @return integer
	 */
	public function getStringMax16() {
		return $this->stringMax16;
	}

	/**
	 * Set stringMax17
	 *
	 * @param integer $stringMax17        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax17($stringMax17) {
		$this->stringMax17 = $stringMax17;
		
		return $this;
	}

	/**
	 * Get stringMax17
	 *
	 * @return integer
	 */
	public function getStringMax17() {
		return $this->stringMax17;
	}

	/**
	 * Set stringMax18
	 *
	 * @param integer $stringMax18        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax18($stringMax18) {
		$this->stringMax18 = $stringMax18;
		
		return $this;
	}

	/**
	 * Get stringMax18
	 *
	 * @return integer
	 */
	public function getStringMax18() {
		return $this->stringMax18;
	}

	/**
	 * Set stringMax19
	 *
	 * @param integer $stringMax19        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax19($stringMax19) {
		$this->stringMax19 = $stringMax19;
		
		return $this;
	}

	/**
	 * Get stringMax19
	 *
	 * @return integer
	 */
	public function getStringMax19() {
		return $this->stringMax19;
	}

	/**
	 * Set stringMax20
	 *
	 * @param integer $stringMax20        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax20($stringMax20) {
		$this->stringMax20 = $stringMax20;
		
		return $this;
	}

	/**
	 * Get stringMax20
	 *
	 * @return integer
	 */
	public function getStringMax20() {
		return $this->stringMax20;
	}

	/**
	 * Set stringMax21
	 *
	 * @param integer $stringMax21        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax21($stringMax21) {
		$this->stringMax21 = $stringMax21;
		
		return $this;
	}

	/**
	 * Get stringMax21
	 *
	 * @return integer
	 */
	public function getStringMax21() {
		return $this->stringMax21;
	}

	/**
	 * Set stringMax22
	 *
	 * @param integer $stringMax22        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax22($stringMax22) {
		$this->stringMax22 = $stringMax22;
		
		return $this;
	}

	/**
	 * Get stringMax22
	 *
	 * @return integer
	 */
	public function getStringMax22() {
		return $this->stringMax22;
	}

	/**
	 * Set stringMax23
	 *
	 * @param integer $stringMax23        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax23($stringMax23) {
		$this->stringMax23 = $stringMax23;
		
		return $this;
	}

	/**
	 * Get stringMax23
	 *
	 * @return integer
	 */
	public function getStringMax23() {
		return $this->stringMax23;
	}

	/**
	 * Set stringMax24
	 *
	 * @param integer $stringMax24        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax24($stringMax24) {
		$this->stringMax24 = $stringMax24;
		
		return $this;
	}

	/**
	 * Get stringMax24
	 *
	 * @return integer
	 */
	public function getStringMax24() {
		return $this->stringMax24;
	}

	/**
	 * Set stringMax25
	 *
	 * @param integer $stringMax25        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax25($stringMax25) {
		$this->stringMax25 = $stringMax25;
		
		return $this;
	}

	/**
	 * Get stringMax25
	 *
	 * @return integer
	 */
	public function getStringMax25() {
		return $this->stringMax25;
	}

	/**
	 * Set stringMax26
	 *
	 * @param integer $stringMax26        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax26($stringMax26) {
		$this->stringMax26 = $stringMax26;
		
		return $this;
	}

	/**
	 * Get stringMax26
	 *
	 * @return integer
	 */
	public function getStringMax26() {
		return $this->stringMax26;
	}

	/**
	 * Set stringMax27
	 *
	 * @param integer $stringMax27        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax27($stringMax27) {
		$this->stringMax27 = $stringMax27;
		
		return $this;
	}

	/**
	 * Get stringMax27
	 *
	 * @return integer
	 */
	public function getStringMax27() {
		return $this->stringMax27;
	}

	/**
	 * Set stringMax28
	 *
	 * @param integer $stringMax28        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax28($stringMax28) {
		$this->stringMax28 = $stringMax28;
		
		return $this;
	}

	/**
	 * Get stringMax28
	 *
	 * @return integer
	 */
	public function getStringMax28() {
		return $this->stringMax28;
	}

	/**
	 * Set stringMax29
	 *
	 * @param integer $stringMax29        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax29($stringMax29) {
		$this->stringMax29 = $stringMax29;
		
		return $this;
	}

	/**
	 * Get stringMax29
	 *
	 * @return integer
	 */
	public function getStringMax29() {
		return $this->stringMax29;
	}

	/**
	 * Set stringMax30
	 *
	 * @param integer $stringMax30        	
	 *
	 * @return CategorySummary
	 */
	public function setStringMax30($stringMax30) {
		$this->stringMax30 = $stringMax30;
		
		return $this;
	}

	/**
	 * Get stringMax30
	 *
	 * @return integer
	 */
	public function getStringMax30() {
		return $this->stringMax30;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set category
	 *
	 * @param \AppBundle\Entity\Main\Category $category        	
	 *
	 * @return CategorySummary
	 */
	public function setCategory(\AppBundle\Entity\Main\Category $category = null) {
		$this->category = $category;
		
		return $this;
	}

	/**
	 * Get category
	 *
	 * @return \AppBundle\Entity\Main\Category
	 */
	public function getCategory() {
		return $this->category;
	}
}
