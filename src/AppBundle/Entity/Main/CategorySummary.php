<?php

namespace AppBundle\Entity\Main;

class CategorySummary {

	public function offsetExists($offset) {
		if (strpos($offset, 'decimalMin') !== false) {
			return true;
		}
		
		if (strpos($offset, 'decimalMax') !== false) {
			return true;
		}
	
		if (strpos($offset, 'integerMin') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerMax') !== false) {
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
     * @var boolean
     */
    private $upToDate;

    /**
     * @var string
     */
    private $decimalMin1;

    /**
     * @var string
     */
    private $decimalMin2;

    /**
     * @var string
     */
    private $decimalMin3;

    /**
     * @var string
     */
    private $decimalMin4;

    /**
     * @var string
     */
    private $decimalMin5;

    /**
     * @var string
     */
    private $decimalMin6;

    /**
     * @var string
     */
    private $decimalMin7;

    /**
     * @var string
     */
    private $decimalMin8;

    /**
     * @var string
     */
    private $decimalMin9;

    /**
     * @var string
     */
    private $decimalMin10;

    /**
     * @var string
     */
    private $decimalMin11;

    /**
     * @var string
     */
    private $decimalMin12;

    /**
     * @var string
     */
    private $decimalMin13;

    /**
     * @var string
     */
    private $decimalMin14;

    /**
     * @var string
     */
    private $decimalMin15;

    /**
     * @var string
     */
    private $decimalMin16;

    /**
     * @var string
     */
    private $decimalMin17;

    /**
     * @var string
     */
    private $decimalMin18;

    /**
     * @var string
     */
    private $decimalMin19;

    /**
     * @var string
     */
    private $decimalMin20;

    /**
     * @var string
     */
    private $decimalMin21;

    /**
     * @var string
     */
    private $decimalMin22;

    /**
     * @var string
     */
    private $decimalMin23;

    /**
     * @var string
     */
    private $decimalMin24;

    /**
     * @var string
     */
    private $decimalMin25;

    /**
     * @var string
     */
    private $decimalMin26;

    /**
     * @var string
     */
    private $decimalMin27;

    /**
     * @var string
     */
    private $decimalMin28;

    /**
     * @var string
     */
    private $decimalMin29;

    /**
     * @var string
     */
    private $decimalMin30;

    /**
     * @var string
     */
    private $decimalMax1;

    /**
     * @var string
     */
    private $decimalMax2;

    /**
     * @var string
     */
    private $decimalMax3;

    /**
     * @var string
     */
    private $decimalMax4;

    /**
     * @var string
     */
    private $decimalMax5;

    /**
     * @var string
     */
    private $decimalMax6;

    /**
     * @var string
     */
    private $decimalMax7;

    /**
     * @var string
     */
    private $decimalMax8;

    /**
     * @var string
     */
    private $decimalMax9;

    /**
     * @var string
     */
    private $decimalMax10;

    /**
     * @var string
     */
    private $decimalMax11;

    /**
     * @var string
     */
    private $decimalMax12;

    /**
     * @var string
     */
    private $decimalMax13;

    /**
     * @var string
     */
    private $decimalMax14;

    /**
     * @var string
     */
    private $decimalMax15;

    /**
     * @var string
     */
    private $decimalMax16;

    /**
     * @var string
     */
    private $decimalMax17;

    /**
     * @var string
     */
    private $decimalMax18;

    /**
     * @var string
     */
    private $decimalMax19;

    /**
     * @var string
     */
    private $decimalMax20;

    /**
     * @var string
     */
    private $decimalMax21;

    /**
     * @var string
     */
    private $decimalMax22;

    /**
     * @var string
     */
    private $decimalMax23;

    /**
     * @var string
     */
    private $decimalMax24;

    /**
     * @var string
     */
    private $decimalMax25;

    /**
     * @var string
     */
    private $decimalMax26;

    /**
     * @var string
     */
    private $decimalMax27;

    /**
     * @var string
     */
    private $decimalMax28;

    /**
     * @var string
     */
    private $decimalMax29;

    /**
     * @var string
     */
    private $decimalMax30;

    /**
     * @var integer
     */
    private $integerMin1;

    /**
     * @var integer
     */
    private $integerMin2;

    /**
     * @var integer
     */
    private $integerMin3;

    /**
     * @var integer
     */
    private $integerMin4;

    /**
     * @var integer
     */
    private $integerMin5;

    /**
     * @var integer
     */
    private $integerMin6;

    /**
     * @var integer
     */
    private $integerMin7;

    /**
     * @var integer
     */
    private $integerMin8;

    /**
     * @var integer
     */
    private $integerMin9;

    /**
     * @var integer
     */
    private $integerMin10;

    /**
     * @var integer
     */
    private $integerMin11;

    /**
     * @var integer
     */
    private $integerMin12;

    /**
     * @var integer
     */
    private $integerMin13;

    /**
     * @var integer
     */
    private $integerMin14;

    /**
     * @var integer
     */
    private $integerMin15;

    /**
     * @var integer
     */
    private $integerMin16;

    /**
     * @var integer
     */
    private $integerMin17;

    /**
     * @var integer
     */
    private $integerMin18;

    /**
     * @var integer
     */
    private $integerMin19;

    /**
     * @var integer
     */
    private $integerMin20;

    /**
     * @var integer
     */
    private $integerMin21;

    /**
     * @var integer
     */
    private $integerMin22;

    /**
     * @var integer
     */
    private $integerMin23;

    /**
     * @var integer
     */
    private $integerMin24;

    /**
     * @var integer
     */
    private $integerMin25;

    /**
     * @var integer
     */
    private $integerMin26;

    /**
     * @var integer
     */
    private $integerMin27;

    /**
     * @var integer
     */
    private $integerMin28;

    /**
     * @var integer
     */
    private $integerMin29;

    /**
     * @var integer
     */
    private $integerMin30;

    /**
     * @var integer
     */
    private $integerMax1;

    /**
     * @var integer
     */
    private $integerMax2;

    /**
     * @var integer
     */
    private $integerMax3;

    /**
     * @var integer
     */
    private $integerMax4;

    /**
     * @var integer
     */
    private $integerMax5;

    /**
     * @var integer
     */
    private $integerMax6;

    /**
     * @var integer
     */
    private $integerMax7;

    /**
     * @var integer
     */
    private $integerMax8;

    /**
     * @var integer
     */
    private $integerMax9;

    /**
     * @var integer
     */
    private $integerMax10;

    /**
     * @var integer
     */
    private $integerMax11;

    /**
     * @var integer
     */
    private $integerMax12;

    /**
     * @var integer
     */
    private $integerMax13;

    /**
     * @var integer
     */
    private $integerMax14;

    /**
     * @var integer
     */
    private $integerMax15;

    /**
     * @var integer
     */
    private $integerMax16;

    /**
     * @var integer
     */
    private $integerMax17;

    /**
     * @var integer
     */
    private $integerMax18;

    /**
     * @var integer
     */
    private $integerMax19;

    /**
     * @var integer
     */
    private $integerMax20;

    /**
     * @var integer
     */
    private $integerMax21;

    /**
     * @var integer
     */
    private $integerMax22;

    /**
     * @var integer
     */
    private $integerMax23;

    /**
     * @var integer
     */
    private $integerMax24;

    /**
     * @var integer
     */
    private $integerMax25;

    /**
     * @var integer
     */
    private $integerMax26;

    /**
     * @var integer
     */
    private $integerMax27;

    /**
     * @var integer
     */
    private $integerMax28;

    /**
     * @var integer
     */
    private $integerMax29;

    /**
     * @var integer
     */
    private $integerMax30;

    /**
     * @var integer
     */
    private $stringMin1;

    /**
     * @var integer
     */
    private $stringMin2;

    /**
     * @var integer
     */
    private $stringMin3;

    /**
     * @var integer
     */
    private $stringMin4;

    /**
     * @var integer
     */
    private $stringMin5;

    /**
     * @var integer
     */
    private $stringMin6;

    /**
     * @var integer
     */
    private $stringMin7;

    /**
     * @var integer
     */
    private $stringMin8;

    /**
     * @var integer
     */
    private $stringMin9;

    /**
     * @var integer
     */
    private $stringMin10;

    /**
     * @var integer
     */
    private $stringMin11;

    /**
     * @var integer
     */
    private $stringMin12;

    /**
     * @var integer
     */
    private $stringMin13;

    /**
     * @var integer
     */
    private $stringMin14;

    /**
     * @var integer
     */
    private $stringMin15;

    /**
     * @var integer
     */
    private $stringMin16;

    /**
     * @var integer
     */
    private $stringMin17;

    /**
     * @var integer
     */
    private $stringMin18;

    /**
     * @var integer
     */
    private $stringMin19;

    /**
     * @var integer
     */
    private $stringMin20;

    /**
     * @var integer
     */
    private $stringMin21;

    /**
     * @var integer
     */
    private $stringMin22;

    /**
     * @var integer
     */
    private $stringMin23;

    /**
     * @var integer
     */
    private $stringMin24;

    /**
     * @var integer
     */
    private $stringMin25;

    /**
     * @var integer
     */
    private $stringMin26;

    /**
     * @var integer
     */
    private $stringMin27;

    /**
     * @var integer
     */
    private $stringMin28;

    /**
     * @var integer
     */
    private $stringMin29;

    /**
     * @var integer
     */
    private $stringMin30;

    /**
     * @var integer
     */
    private $stringMax1;

    /**
     * @var integer
     */
    private $stringMax2;

    /**
     * @var integer
     */
    private $stringMax3;

    /**
     * @var integer
     */
    private $stringMax4;

    /**
     * @var integer
     */
    private $stringMax5;

    /**
     * @var integer
     */
    private $stringMax6;

    /**
     * @var integer
     */
    private $stringMax7;

    /**
     * @var integer
     */
    private $stringMax8;

    /**
     * @var integer
     */
    private $stringMax9;

    /**
     * @var integer
     */
    private $stringMax10;

    /**
     * @var integer
     */
    private $stringMax11;

    /**
     * @var integer
     */
    private $stringMax12;

    /**
     * @var integer
     */
    private $stringMax13;

    /**
     * @var integer
     */
    private $stringMax14;

    /**
     * @var integer
     */
    private $stringMax15;

    /**
     * @var integer
     */
    private $stringMax16;

    /**
     * @var integer
     */
    private $stringMax17;

    /**
     * @var integer
     */
    private $stringMax18;

    /**
     * @var integer
     */
    private $stringMax19;

    /**
     * @var integer
     */
    private $stringMax20;

    /**
     * @var integer
     */
    private $stringMax21;

    /**
     * @var integer
     */
    private $stringMax22;

    /**
     * @var integer
     */
    private $stringMax23;

    /**
     * @var integer
     */
    private $stringMax24;

    /**
     * @var integer
     */
    private $stringMax25;

    /**
     * @var integer
     */
    private $stringMax26;

    /**
     * @var integer
     */
    private $stringMax27;

    /**
     * @var integer
     */
    private $stringMax28;

    /**
     * @var integer
     */
    private $stringMax29;

    /**
     * @var integer
     */
    private $stringMax30;

    /**
     * @var integer
     */
    private $id;

    /**
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
     * Set decimalMin1
     *
     * @param string $decimalMin1
     *
     * @return CategorySummary
     */
    public function setDecimalMin1($decimalMin1)
    {
        $this->decimalMin1 = $decimalMin1;

        return $this;
    }

    /**
     * Get decimalMin1
     *
     * @return string
     */
    public function getDecimalMin1()
    {
        return $this->decimalMin1;
    }

    /**
     * Set decimalMin2
     *
     * @param string $decimalMin2
     *
     * @return CategorySummary
     */
    public function setDecimalMin2($decimalMin2)
    {
        $this->decimalMin2 = $decimalMin2;

        return $this;
    }

    /**
     * Get decimalMin2
     *
     * @return string
     */
    public function getDecimalMin2()
    {
        return $this->decimalMin2;
    }

    /**
     * Set decimalMin3
     *
     * @param string $decimalMin3
     *
     * @return CategorySummary
     */
    public function setDecimalMin3($decimalMin3)
    {
        $this->decimalMin3 = $decimalMin3;

        return $this;
    }

    /**
     * Get decimalMin3
     *
     * @return string
     */
    public function getDecimalMin3()
    {
        return $this->decimalMin3;
    }

    /**
     * Set decimalMin4
     *
     * @param string $decimalMin4
     *
     * @return CategorySummary
     */
    public function setDecimalMin4($decimalMin4)
    {
        $this->decimalMin4 = $decimalMin4;

        return $this;
    }

    /**
     * Get decimalMin4
     *
     * @return string
     */
    public function getDecimalMin4()
    {
        return $this->decimalMin4;
    }

    /**
     * Set decimalMin5
     *
     * @param string $decimalMin5
     *
     * @return CategorySummary
     */
    public function setDecimalMin5($decimalMin5)
    {
        $this->decimalMin5 = $decimalMin5;

        return $this;
    }

    /**
     * Get decimalMin5
     *
     * @return string
     */
    public function getDecimalMin5()
    {
        return $this->decimalMin5;
    }

    /**
     * Set decimalMin6
     *
     * @param string $decimalMin6
     *
     * @return CategorySummary
     */
    public function setDecimalMin6($decimalMin6)
    {
        $this->decimalMin6 = $decimalMin6;

        return $this;
    }

    /**
     * Get decimalMin6
     *
     * @return string
     */
    public function getDecimalMin6()
    {
        return $this->decimalMin6;
    }

    /**
     * Set decimalMin7
     *
     * @param string $decimalMin7
     *
     * @return CategorySummary
     */
    public function setDecimalMin7($decimalMin7)
    {
        $this->decimalMin7 = $decimalMin7;

        return $this;
    }

    /**
     * Get decimalMin7
     *
     * @return string
     */
    public function getDecimalMin7()
    {
        return $this->decimalMin7;
    }

    /**
     * Set decimalMin8
     *
     * @param string $decimalMin8
     *
     * @return CategorySummary
     */
    public function setDecimalMin8($decimalMin8)
    {
        $this->decimalMin8 = $decimalMin8;

        return $this;
    }

    /**
     * Get decimalMin8
     *
     * @return string
     */
    public function getDecimalMin8()
    {
        return $this->decimalMin8;
    }

    /**
     * Set decimalMin9
     *
     * @param string $decimalMin9
     *
     * @return CategorySummary
     */
    public function setDecimalMin9($decimalMin9)
    {
        $this->decimalMin9 = $decimalMin9;

        return $this;
    }

    /**
     * Get decimalMin9
     *
     * @return string
     */
    public function getDecimalMin9()
    {
        return $this->decimalMin9;
    }

    /**
     * Set decimalMin10
     *
     * @param string $decimalMin10
     *
     * @return CategorySummary
     */
    public function setDecimalMin10($decimalMin10)
    {
        $this->decimalMin10 = $decimalMin10;

        return $this;
    }

    /**
     * Get decimalMin10
     *
     * @return string
     */
    public function getDecimalMin10()
    {
        return $this->decimalMin10;
    }

    /**
     * Set decimalMin11
     *
     * @param string $decimalMin11
     *
     * @return CategorySummary
     */
    public function setDecimalMin11($decimalMin11)
    {
        $this->decimalMin11 = $decimalMin11;

        return $this;
    }

    /**
     * Get decimalMin11
     *
     * @return string
     */
    public function getDecimalMin11()
    {
        return $this->decimalMin11;
    }

    /**
     * Set decimalMin12
     *
     * @param string $decimalMin12
     *
     * @return CategorySummary
     */
    public function setDecimalMin12($decimalMin12)
    {
        $this->decimalMin12 = $decimalMin12;

        return $this;
    }

    /**
     * Get decimalMin12
     *
     * @return string
     */
    public function getDecimalMin12()
    {
        return $this->decimalMin12;
    }

    /**
     * Set decimalMin13
     *
     * @param string $decimalMin13
     *
     * @return CategorySummary
     */
    public function setDecimalMin13($decimalMin13)
    {
        $this->decimalMin13 = $decimalMin13;

        return $this;
    }

    /**
     * Get decimalMin13
     *
     * @return string
     */
    public function getDecimalMin13()
    {
        return $this->decimalMin13;
    }

    /**
     * Set decimalMin14
     *
     * @param string $decimalMin14
     *
     * @return CategorySummary
     */
    public function setDecimalMin14($decimalMin14)
    {
        $this->decimalMin14 = $decimalMin14;

        return $this;
    }

    /**
     * Get decimalMin14
     *
     * @return string
     */
    public function getDecimalMin14()
    {
        return $this->decimalMin14;
    }

    /**
     * Set decimalMin15
     *
     * @param string $decimalMin15
     *
     * @return CategorySummary
     */
    public function setDecimalMin15($decimalMin15)
    {
        $this->decimalMin15 = $decimalMin15;

        return $this;
    }

    /**
     * Get decimalMin15
     *
     * @return string
     */
    public function getDecimalMin15()
    {
        return $this->decimalMin15;
    }

    /**
     * Set decimalMin16
     *
     * @param string $decimalMin16
     *
     * @return CategorySummary
     */
    public function setDecimalMin16($decimalMin16)
    {
        $this->decimalMin16 = $decimalMin16;

        return $this;
    }

    /**
     * Get decimalMin16
     *
     * @return string
     */
    public function getDecimalMin16()
    {
        return $this->decimalMin16;
    }

    /**
     * Set decimalMin17
     *
     * @param string $decimalMin17
     *
     * @return CategorySummary
     */
    public function setDecimalMin17($decimalMin17)
    {
        $this->decimalMin17 = $decimalMin17;

        return $this;
    }

    /**
     * Get decimalMin17
     *
     * @return string
     */
    public function getDecimalMin17()
    {
        return $this->decimalMin17;
    }

    /**
     * Set decimalMin18
     *
     * @param string $decimalMin18
     *
     * @return CategorySummary
     */
    public function setDecimalMin18($decimalMin18)
    {
        $this->decimalMin18 = $decimalMin18;

        return $this;
    }

    /**
     * Get decimalMin18
     *
     * @return string
     */
    public function getDecimalMin18()
    {
        return $this->decimalMin18;
    }

    /**
     * Set decimalMin19
     *
     * @param string $decimalMin19
     *
     * @return CategorySummary
     */
    public function setDecimalMin19($decimalMin19)
    {
        $this->decimalMin19 = $decimalMin19;

        return $this;
    }

    /**
     * Get decimalMin19
     *
     * @return string
     */
    public function getDecimalMin19()
    {
        return $this->decimalMin19;
    }

    /**
     * Set decimalMin20
     *
     * @param string $decimalMin20
     *
     * @return CategorySummary
     */
    public function setDecimalMin20($decimalMin20)
    {
        $this->decimalMin20 = $decimalMin20;

        return $this;
    }

    /**
     * Get decimalMin20
     *
     * @return string
     */
    public function getDecimalMin20()
    {
        return $this->decimalMin20;
    }

    /**
     * Set decimalMin21
     *
     * @param string $decimalMin21
     *
     * @return CategorySummary
     */
    public function setDecimalMin21($decimalMin21)
    {
        $this->decimalMin21 = $decimalMin21;

        return $this;
    }

    /**
     * Get decimalMin21
     *
     * @return string
     */
    public function getDecimalMin21()
    {
        return $this->decimalMin21;
    }

    /**
     * Set decimalMin22
     *
     * @param string $decimalMin22
     *
     * @return CategorySummary
     */
    public function setDecimalMin22($decimalMin22)
    {
        $this->decimalMin22 = $decimalMin22;

        return $this;
    }

    /**
     * Get decimalMin22
     *
     * @return string
     */
    public function getDecimalMin22()
    {
        return $this->decimalMin22;
    }

    /**
     * Set decimalMin23
     *
     * @param string $decimalMin23
     *
     * @return CategorySummary
     */
    public function setDecimalMin23($decimalMin23)
    {
        $this->decimalMin23 = $decimalMin23;

        return $this;
    }

    /**
     * Get decimalMin23
     *
     * @return string
     */
    public function getDecimalMin23()
    {
        return $this->decimalMin23;
    }

    /**
     * Set decimalMin24
     *
     * @param string $decimalMin24
     *
     * @return CategorySummary
     */
    public function setDecimalMin24($decimalMin24)
    {
        $this->decimalMin24 = $decimalMin24;

        return $this;
    }

    /**
     * Get decimalMin24
     *
     * @return string
     */
    public function getDecimalMin24()
    {
        return $this->decimalMin24;
    }

    /**
     * Set decimalMin25
     *
     * @param string $decimalMin25
     *
     * @return CategorySummary
     */
    public function setDecimalMin25($decimalMin25)
    {
        $this->decimalMin25 = $decimalMin25;

        return $this;
    }

    /**
     * Get decimalMin25
     *
     * @return string
     */
    public function getDecimalMin25()
    {
        return $this->decimalMin25;
    }

    /**
     * Set decimalMin26
     *
     * @param string $decimalMin26
     *
     * @return CategorySummary
     */
    public function setDecimalMin26($decimalMin26)
    {
        $this->decimalMin26 = $decimalMin26;

        return $this;
    }

    /**
     * Get decimalMin26
     *
     * @return string
     */
    public function getDecimalMin26()
    {
        return $this->decimalMin26;
    }

    /**
     * Set decimalMin27
     *
     * @param string $decimalMin27
     *
     * @return CategorySummary
     */
    public function setDecimalMin27($decimalMin27)
    {
        $this->decimalMin27 = $decimalMin27;

        return $this;
    }

    /**
     * Get decimalMin27
     *
     * @return string
     */
    public function getDecimalMin27()
    {
        return $this->decimalMin27;
    }

    /**
     * Set decimalMin28
     *
     * @param string $decimalMin28
     *
     * @return CategorySummary
     */
    public function setDecimalMin28($decimalMin28)
    {
        $this->decimalMin28 = $decimalMin28;

        return $this;
    }

    /**
     * Get decimalMin28
     *
     * @return string
     */
    public function getDecimalMin28()
    {
        return $this->decimalMin28;
    }

    /**
     * Set decimalMin29
     *
     * @param string $decimalMin29
     *
     * @return CategorySummary
     */
    public function setDecimalMin29($decimalMin29)
    {
        $this->decimalMin29 = $decimalMin29;

        return $this;
    }

    /**
     * Get decimalMin29
     *
     * @return string
     */
    public function getDecimalMin29()
    {
        return $this->decimalMin29;
    }

    /**
     * Set decimalMin30
     *
     * @param string $decimalMin30
     *
     * @return CategorySummary
     */
    public function setDecimalMin30($decimalMin30)
    {
        $this->decimalMin30 = $decimalMin30;

        return $this;
    }

    /**
     * Get decimalMin30
     *
     * @return string
     */
    public function getDecimalMin30()
    {
        return $this->decimalMin30;
    }

    /**
     * Set decimalMax1
     *
     * @param string $decimalMax1
     *
     * @return CategorySummary
     */
    public function setDecimalMax1($decimalMax1)
    {
        $this->decimalMax1 = $decimalMax1;

        return $this;
    }

    /**
     * Get decimalMax1
     *
     * @return string
     */
    public function getDecimalMax1()
    {
        return $this->decimalMax1;
    }

    /**
     * Set decimalMax2
     *
     * @param string $decimalMax2
     *
     * @return CategorySummary
     */
    public function setDecimalMax2($decimalMax2)
    {
        $this->decimalMax2 = $decimalMax2;

        return $this;
    }

    /**
     * Get decimalMax2
     *
     * @return string
     */
    public function getDecimalMax2()
    {
        return $this->decimalMax2;
    }

    /**
     * Set decimalMax3
     *
     * @param string $decimalMax3
     *
     * @return CategorySummary
     */
    public function setDecimalMax3($decimalMax3)
    {
        $this->decimalMax3 = $decimalMax3;

        return $this;
    }

    /**
     * Get decimalMax3
     *
     * @return string
     */
    public function getDecimalMax3()
    {
        return $this->decimalMax3;
    }

    /**
     * Set decimalMax4
     *
     * @param string $decimalMax4
     *
     * @return CategorySummary
     */
    public function setDecimalMax4($decimalMax4)
    {
        $this->decimalMax4 = $decimalMax4;

        return $this;
    }

    /**
     * Get decimalMax4
     *
     * @return string
     */
    public function getDecimalMax4()
    {
        return $this->decimalMax4;
    }

    /**
     * Set decimalMax5
     *
     * @param string $decimalMax5
     *
     * @return CategorySummary
     */
    public function setDecimalMax5($decimalMax5)
    {
        $this->decimalMax5 = $decimalMax5;

        return $this;
    }

    /**
     * Get decimalMax5
     *
     * @return string
     */
    public function getDecimalMax5()
    {
        return $this->decimalMax5;
    }

    /**
     * Set decimalMax6
     *
     * @param string $decimalMax6
     *
     * @return CategorySummary
     */
    public function setDecimalMax6($decimalMax6)
    {
        $this->decimalMax6 = $decimalMax6;

        return $this;
    }

    /**
     * Get decimalMax6
     *
     * @return string
     */
    public function getDecimalMax6()
    {
        return $this->decimalMax6;
    }

    /**
     * Set decimalMax7
     *
     * @param string $decimalMax7
     *
     * @return CategorySummary
     */
    public function setDecimalMax7($decimalMax7)
    {
        $this->decimalMax7 = $decimalMax7;

        return $this;
    }

    /**
     * Get decimalMax7
     *
     * @return string
     */
    public function getDecimalMax7()
    {
        return $this->decimalMax7;
    }

    /**
     * Set decimalMax8
     *
     * @param string $decimalMax8
     *
     * @return CategorySummary
     */
    public function setDecimalMax8($decimalMax8)
    {
        $this->decimalMax8 = $decimalMax8;

        return $this;
    }

    /**
     * Get decimalMax8
     *
     * @return string
     */
    public function getDecimalMax8()
    {
        return $this->decimalMax8;
    }

    /**
     * Set decimalMax9
     *
     * @param string $decimalMax9
     *
     * @return CategorySummary
     */
    public function setDecimalMax9($decimalMax9)
    {
        $this->decimalMax9 = $decimalMax9;

        return $this;
    }

    /**
     * Get decimalMax9
     *
     * @return string
     */
    public function getDecimalMax9()
    {
        return $this->decimalMax9;
    }

    /**
     * Set decimalMax10
     *
     * @param string $decimalMax10
     *
     * @return CategorySummary
     */
    public function setDecimalMax10($decimalMax10)
    {
        $this->decimalMax10 = $decimalMax10;

        return $this;
    }

    /**
     * Get decimalMax10
     *
     * @return string
     */
    public function getDecimalMax10()
    {
        return $this->decimalMax10;
    }

    /**
     * Set decimalMax11
     *
     * @param string $decimalMax11
     *
     * @return CategorySummary
     */
    public function setDecimalMax11($decimalMax11)
    {
        $this->decimalMax11 = $decimalMax11;

        return $this;
    }

    /**
     * Get decimalMax11
     *
     * @return string
     */
    public function getDecimalMax11()
    {
        return $this->decimalMax11;
    }

    /**
     * Set decimalMax12
     *
     * @param string $decimalMax12
     *
     * @return CategorySummary
     */
    public function setDecimalMax12($decimalMax12)
    {
        $this->decimalMax12 = $decimalMax12;

        return $this;
    }

    /**
     * Get decimalMax12
     *
     * @return string
     */
    public function getDecimalMax12()
    {
        return $this->decimalMax12;
    }

    /**
     * Set decimalMax13
     *
     * @param string $decimalMax13
     *
     * @return CategorySummary
     */
    public function setDecimalMax13($decimalMax13)
    {
        $this->decimalMax13 = $decimalMax13;

        return $this;
    }

    /**
     * Get decimalMax13
     *
     * @return string
     */
    public function getDecimalMax13()
    {
        return $this->decimalMax13;
    }

    /**
     * Set decimalMax14
     *
     * @param string $decimalMax14
     *
     * @return CategorySummary
     */
    public function setDecimalMax14($decimalMax14)
    {
        $this->decimalMax14 = $decimalMax14;

        return $this;
    }

    /**
     * Get decimalMax14
     *
     * @return string
     */
    public function getDecimalMax14()
    {
        return $this->decimalMax14;
    }

    /**
     * Set decimalMax15
     *
     * @param string $decimalMax15
     *
     * @return CategorySummary
     */
    public function setDecimalMax15($decimalMax15)
    {
        $this->decimalMax15 = $decimalMax15;

        return $this;
    }

    /**
     * Get decimalMax15
     *
     * @return string
     */
    public function getDecimalMax15()
    {
        return $this->decimalMax15;
    }

    /**
     * Set decimalMax16
     *
     * @param string $decimalMax16
     *
     * @return CategorySummary
     */
    public function setDecimalMax16($decimalMax16)
    {
        $this->decimalMax16 = $decimalMax16;

        return $this;
    }

    /**
     * Get decimalMax16
     *
     * @return string
     */
    public function getDecimalMax16()
    {
        return $this->decimalMax16;
    }

    /**
     * Set decimalMax17
     *
     * @param string $decimalMax17
     *
     * @return CategorySummary
     */
    public function setDecimalMax17($decimalMax17)
    {
        $this->decimalMax17 = $decimalMax17;

        return $this;
    }

    /**
     * Get decimalMax17
     *
     * @return string
     */
    public function getDecimalMax17()
    {
        return $this->decimalMax17;
    }

    /**
     * Set decimalMax18
     *
     * @param string $decimalMax18
     *
     * @return CategorySummary
     */
    public function setDecimalMax18($decimalMax18)
    {
        $this->decimalMax18 = $decimalMax18;

        return $this;
    }

    /**
     * Get decimalMax18
     *
     * @return string
     */
    public function getDecimalMax18()
    {
        return $this->decimalMax18;
    }

    /**
     * Set decimalMax19
     *
     * @param string $decimalMax19
     *
     * @return CategorySummary
     */
    public function setDecimalMax19($decimalMax19)
    {
        $this->decimalMax19 = $decimalMax19;

        return $this;
    }

    /**
     * Get decimalMax19
     *
     * @return string
     */
    public function getDecimalMax19()
    {
        return $this->decimalMax19;
    }

    /**
     * Set decimalMax20
     *
     * @param string $decimalMax20
     *
     * @return CategorySummary
     */
    public function setDecimalMax20($decimalMax20)
    {
        $this->decimalMax20 = $decimalMax20;

        return $this;
    }

    /**
     * Get decimalMax20
     *
     * @return string
     */
    public function getDecimalMax20()
    {
        return $this->decimalMax20;
    }

    /**
     * Set decimalMax21
     *
     * @param string $decimalMax21
     *
     * @return CategorySummary
     */
    public function setDecimalMax21($decimalMax21)
    {
        $this->decimalMax21 = $decimalMax21;

        return $this;
    }

    /**
     * Get decimalMax21
     *
     * @return string
     */
    public function getDecimalMax21()
    {
        return $this->decimalMax21;
    }

    /**
     * Set decimalMax22
     *
     * @param string $decimalMax22
     *
     * @return CategorySummary
     */
    public function setDecimalMax22($decimalMax22)
    {
        $this->decimalMax22 = $decimalMax22;

        return $this;
    }

    /**
     * Get decimalMax22
     *
     * @return string
     */
    public function getDecimalMax22()
    {
        return $this->decimalMax22;
    }

    /**
     * Set decimalMax23
     *
     * @param string $decimalMax23
     *
     * @return CategorySummary
     */
    public function setDecimalMax23($decimalMax23)
    {
        $this->decimalMax23 = $decimalMax23;

        return $this;
    }

    /**
     * Get decimalMax23
     *
     * @return string
     */
    public function getDecimalMax23()
    {
        return $this->decimalMax23;
    }

    /**
     * Set decimalMax24
     *
     * @param string $decimalMax24
     *
     * @return CategorySummary
     */
    public function setDecimalMax24($decimalMax24)
    {
        $this->decimalMax24 = $decimalMax24;

        return $this;
    }

    /**
     * Get decimalMax24
     *
     * @return string
     */
    public function getDecimalMax24()
    {
        return $this->decimalMax24;
    }

    /**
     * Set decimalMax25
     *
     * @param string $decimalMax25
     *
     * @return CategorySummary
     */
    public function setDecimalMax25($decimalMax25)
    {
        $this->decimalMax25 = $decimalMax25;

        return $this;
    }

    /**
     * Get decimalMax25
     *
     * @return string
     */
    public function getDecimalMax25()
    {
        return $this->decimalMax25;
    }

    /**
     * Set decimalMax26
     *
     * @param string $decimalMax26
     *
     * @return CategorySummary
     */
    public function setDecimalMax26($decimalMax26)
    {
        $this->decimalMax26 = $decimalMax26;

        return $this;
    }

    /**
     * Get decimalMax26
     *
     * @return string
     */
    public function getDecimalMax26()
    {
        return $this->decimalMax26;
    }

    /**
     * Set decimalMax27
     *
     * @param string $decimalMax27
     *
     * @return CategorySummary
     */
    public function setDecimalMax27($decimalMax27)
    {
        $this->decimalMax27 = $decimalMax27;

        return $this;
    }

    /**
     * Get decimalMax27
     *
     * @return string
     */
    public function getDecimalMax27()
    {
        return $this->decimalMax27;
    }

    /**
     * Set decimalMax28
     *
     * @param string $decimalMax28
     *
     * @return CategorySummary
     */
    public function setDecimalMax28($decimalMax28)
    {
        $this->decimalMax28 = $decimalMax28;

        return $this;
    }

    /**
     * Get decimalMax28
     *
     * @return string
     */
    public function getDecimalMax28()
    {
        return $this->decimalMax28;
    }

    /**
     * Set decimalMax29
     *
     * @param string $decimalMax29
     *
     * @return CategorySummary
     */
    public function setDecimalMax29($decimalMax29)
    {
        $this->decimalMax29 = $decimalMax29;

        return $this;
    }

    /**
     * Get decimalMax29
     *
     * @return string
     */
    public function getDecimalMax29()
    {
        return $this->decimalMax29;
    }

    /**
     * Set decimalMax30
     *
     * @param string $decimalMax30
     *
     * @return CategorySummary
     */
    public function setDecimalMax30($decimalMax30)
    {
        $this->decimalMax30 = $decimalMax30;

        return $this;
    }

    /**
     * Get decimalMax30
     *
     * @return string
     */
    public function getDecimalMax30()
    {
        return $this->decimalMax30;
    }

    /**
     * Set integerMin1
     *
     * @param integer $integerMin1
     *
     * @return CategorySummary
     */
    public function setIntegerMin1($integerMin1)
    {
        $this->integerMin1 = $integerMin1;

        return $this;
    }

    /**
     * Get integerMin1
     *
     * @return integer
     */
    public function getIntegerMin1()
    {
        return $this->integerMin1;
    }

    /**
     * Set integerMin2
     *
     * @param integer $integerMin2
     *
     * @return CategorySummary
     */
    public function setIntegerMin2($integerMin2)
    {
        $this->integerMin2 = $integerMin2;

        return $this;
    }

    /**
     * Get integerMin2
     *
     * @return integer
     */
    public function getIntegerMin2()
    {
        return $this->integerMin2;
    }

    /**
     * Set integerMin3
     *
     * @param integer $integerMin3
     *
     * @return CategorySummary
     */
    public function setIntegerMin3($integerMin3)
    {
        $this->integerMin3 = $integerMin3;

        return $this;
    }

    /**
     * Get integerMin3
     *
     * @return integer
     */
    public function getIntegerMin3()
    {
        return $this->integerMin3;
    }

    /**
     * Set integerMin4
     *
     * @param integer $integerMin4
     *
     * @return CategorySummary
     */
    public function setIntegerMin4($integerMin4)
    {
        $this->integerMin4 = $integerMin4;

        return $this;
    }

    /**
     * Get integerMin4
     *
     * @return integer
     */
    public function getIntegerMin4()
    {
        return $this->integerMin4;
    }

    /**
     * Set integerMin5
     *
     * @param integer $integerMin5
     *
     * @return CategorySummary
     */
    public function setIntegerMin5($integerMin5)
    {
        $this->integerMin5 = $integerMin5;

        return $this;
    }

    /**
     * Get integerMin5
     *
     * @return integer
     */
    public function getIntegerMin5()
    {
        return $this->integerMin5;
    }

    /**
     * Set integerMin6
     *
     * @param integer $integerMin6
     *
     * @return CategorySummary
     */
    public function setIntegerMin6($integerMin6)
    {
        $this->integerMin6 = $integerMin6;

        return $this;
    }

    /**
     * Get integerMin6
     *
     * @return integer
     */
    public function getIntegerMin6()
    {
        return $this->integerMin6;
    }

    /**
     * Set integerMin7
     *
     * @param integer $integerMin7
     *
     * @return CategorySummary
     */
    public function setIntegerMin7($integerMin7)
    {
        $this->integerMin7 = $integerMin7;

        return $this;
    }

    /**
     * Get integerMin7
     *
     * @return integer
     */
    public function getIntegerMin7()
    {
        return $this->integerMin7;
    }

    /**
     * Set integerMin8
     *
     * @param integer $integerMin8
     *
     * @return CategorySummary
     */
    public function setIntegerMin8($integerMin8)
    {
        $this->integerMin8 = $integerMin8;

        return $this;
    }

    /**
     * Get integerMin8
     *
     * @return integer
     */
    public function getIntegerMin8()
    {
        return $this->integerMin8;
    }

    /**
     * Set integerMin9
     *
     * @param integer $integerMin9
     *
     * @return CategorySummary
     */
    public function setIntegerMin9($integerMin9)
    {
        $this->integerMin9 = $integerMin9;

        return $this;
    }

    /**
     * Get integerMin9
     *
     * @return integer
     */
    public function getIntegerMin9()
    {
        return $this->integerMin9;
    }

    /**
     * Set integerMin10
     *
     * @param integer $integerMin10
     *
     * @return CategorySummary
     */
    public function setIntegerMin10($integerMin10)
    {
        $this->integerMin10 = $integerMin10;

        return $this;
    }

    /**
     * Get integerMin10
     *
     * @return integer
     */
    public function getIntegerMin10()
    {
        return $this->integerMin10;
    }

    /**
     * Set integerMin11
     *
     * @param integer $integerMin11
     *
     * @return CategorySummary
     */
    public function setIntegerMin11($integerMin11)
    {
        $this->integerMin11 = $integerMin11;

        return $this;
    }

    /**
     * Get integerMin11
     *
     * @return integer
     */
    public function getIntegerMin11()
    {
        return $this->integerMin11;
    }

    /**
     * Set integerMin12
     *
     * @param integer $integerMin12
     *
     * @return CategorySummary
     */
    public function setIntegerMin12($integerMin12)
    {
        $this->integerMin12 = $integerMin12;

        return $this;
    }

    /**
     * Get integerMin12
     *
     * @return integer
     */
    public function getIntegerMin12()
    {
        return $this->integerMin12;
    }

    /**
     * Set integerMin13
     *
     * @param integer $integerMin13
     *
     * @return CategorySummary
     */
    public function setIntegerMin13($integerMin13)
    {
        $this->integerMin13 = $integerMin13;

        return $this;
    }

    /**
     * Get integerMin13
     *
     * @return integer
     */
    public function getIntegerMin13()
    {
        return $this->integerMin13;
    }

    /**
     * Set integerMin14
     *
     * @param integer $integerMin14
     *
     * @return CategorySummary
     */
    public function setIntegerMin14($integerMin14)
    {
        $this->integerMin14 = $integerMin14;

        return $this;
    }

    /**
     * Get integerMin14
     *
     * @return integer
     */
    public function getIntegerMin14()
    {
        return $this->integerMin14;
    }

    /**
     * Set integerMin15
     *
     * @param integer $integerMin15
     *
     * @return CategorySummary
     */
    public function setIntegerMin15($integerMin15)
    {
        $this->integerMin15 = $integerMin15;

        return $this;
    }

    /**
     * Get integerMin15
     *
     * @return integer
     */
    public function getIntegerMin15()
    {
        return $this->integerMin15;
    }

    /**
     * Set integerMin16
     *
     * @param integer $integerMin16
     *
     * @return CategorySummary
     */
    public function setIntegerMin16($integerMin16)
    {
        $this->integerMin16 = $integerMin16;

        return $this;
    }

    /**
     * Get integerMin16
     *
     * @return integer
     */
    public function getIntegerMin16()
    {
        return $this->integerMin16;
    }

    /**
     * Set integerMin17
     *
     * @param integer $integerMin17
     *
     * @return CategorySummary
     */
    public function setIntegerMin17($integerMin17)
    {
        $this->integerMin17 = $integerMin17;

        return $this;
    }

    /**
     * Get integerMin17
     *
     * @return integer
     */
    public function getIntegerMin17()
    {
        return $this->integerMin17;
    }

    /**
     * Set integerMin18
     *
     * @param integer $integerMin18
     *
     * @return CategorySummary
     */
    public function setIntegerMin18($integerMin18)
    {
        $this->integerMin18 = $integerMin18;

        return $this;
    }

    /**
     * Get integerMin18
     *
     * @return integer
     */
    public function getIntegerMin18()
    {
        return $this->integerMin18;
    }

    /**
     * Set integerMin19
     *
     * @param integer $integerMin19
     *
     * @return CategorySummary
     */
    public function setIntegerMin19($integerMin19)
    {
        $this->integerMin19 = $integerMin19;

        return $this;
    }

    /**
     * Get integerMin19
     *
     * @return integer
     */
    public function getIntegerMin19()
    {
        return $this->integerMin19;
    }

    /**
     * Set integerMin20
     *
     * @param integer $integerMin20
     *
     * @return CategorySummary
     */
    public function setIntegerMin20($integerMin20)
    {
        $this->integerMin20 = $integerMin20;

        return $this;
    }

    /**
     * Get integerMin20
     *
     * @return integer
     */
    public function getIntegerMin20()
    {
        return $this->integerMin20;
    }

    /**
     * Set integerMin21
     *
     * @param integer $integerMin21
     *
     * @return CategorySummary
     */
    public function setIntegerMin21($integerMin21)
    {
        $this->integerMin21 = $integerMin21;

        return $this;
    }

    /**
     * Get integerMin21
     *
     * @return integer
     */
    public function getIntegerMin21()
    {
        return $this->integerMin21;
    }

    /**
     * Set integerMin22
     *
     * @param integer $integerMin22
     *
     * @return CategorySummary
     */
    public function setIntegerMin22($integerMin22)
    {
        $this->integerMin22 = $integerMin22;

        return $this;
    }

    /**
     * Get integerMin22
     *
     * @return integer
     */
    public function getIntegerMin22()
    {
        return $this->integerMin22;
    }

    /**
     * Set integerMin23
     *
     * @param integer $integerMin23
     *
     * @return CategorySummary
     */
    public function setIntegerMin23($integerMin23)
    {
        $this->integerMin23 = $integerMin23;

        return $this;
    }

    /**
     * Get integerMin23
     *
     * @return integer
     */
    public function getIntegerMin23()
    {
        return $this->integerMin23;
    }

    /**
     * Set integerMin24
     *
     * @param integer $integerMin24
     *
     * @return CategorySummary
     */
    public function setIntegerMin24($integerMin24)
    {
        $this->integerMin24 = $integerMin24;

        return $this;
    }

    /**
     * Get integerMin24
     *
     * @return integer
     */
    public function getIntegerMin24()
    {
        return $this->integerMin24;
    }

    /**
     * Set integerMin25
     *
     * @param integer $integerMin25
     *
     * @return CategorySummary
     */
    public function setIntegerMin25($integerMin25)
    {
        $this->integerMin25 = $integerMin25;

        return $this;
    }

    /**
     * Get integerMin25
     *
     * @return integer
     */
    public function getIntegerMin25()
    {
        return $this->integerMin25;
    }

    /**
     * Set integerMin26
     *
     * @param integer $integerMin26
     *
     * @return CategorySummary
     */
    public function setIntegerMin26($integerMin26)
    {
        $this->integerMin26 = $integerMin26;

        return $this;
    }

    /**
     * Get integerMin26
     *
     * @return integer
     */
    public function getIntegerMin26()
    {
        return $this->integerMin26;
    }

    /**
     * Set integerMin27
     *
     * @param integer $integerMin27
     *
     * @return CategorySummary
     */
    public function setIntegerMin27($integerMin27)
    {
        $this->integerMin27 = $integerMin27;

        return $this;
    }

    /**
     * Get integerMin27
     *
     * @return integer
     */
    public function getIntegerMin27()
    {
        return $this->integerMin27;
    }

    /**
     * Set integerMin28
     *
     * @param integer $integerMin28
     *
     * @return CategorySummary
     */
    public function setIntegerMin28($integerMin28)
    {
        $this->integerMin28 = $integerMin28;

        return $this;
    }

    /**
     * Get integerMin28
     *
     * @return integer
     */
    public function getIntegerMin28()
    {
        return $this->integerMin28;
    }

    /**
     * Set integerMin29
     *
     * @param integer $integerMin29
     *
     * @return CategorySummary
     */
    public function setIntegerMin29($integerMin29)
    {
        $this->integerMin29 = $integerMin29;

        return $this;
    }

    /**
     * Get integerMin29
     *
     * @return integer
     */
    public function getIntegerMin29()
    {
        return $this->integerMin29;
    }

    /**
     * Set integerMin30
     *
     * @param integer $integerMin30
     *
     * @return CategorySummary
     */
    public function setIntegerMin30($integerMin30)
    {
        $this->integerMin30 = $integerMin30;

        return $this;
    }

    /**
     * Get integerMin30
     *
     * @return integer
     */
    public function getIntegerMin30()
    {
        return $this->integerMin30;
    }

    /**
     * Set integerMax1
     *
     * @param integer $integerMax1
     *
     * @return CategorySummary
     */
    public function setIntegerMax1($integerMax1)
    {
        $this->integerMax1 = $integerMax1;

        return $this;
    }

    /**
     * Get integerMax1
     *
     * @return integer
     */
    public function getIntegerMax1()
    {
        return $this->integerMax1;
    }

    /**
     * Set integerMax2
     *
     * @param integer $integerMax2
     *
     * @return CategorySummary
     */
    public function setIntegerMax2($integerMax2)
    {
        $this->integerMax2 = $integerMax2;

        return $this;
    }

    /**
     * Get integerMax2
     *
     * @return integer
     */
    public function getIntegerMax2()
    {
        return $this->integerMax2;
    }

    /**
     * Set integerMax3
     *
     * @param integer $integerMax3
     *
     * @return CategorySummary
     */
    public function setIntegerMax3($integerMax3)
    {
        $this->integerMax3 = $integerMax3;

        return $this;
    }

    /**
     * Get integerMax3
     *
     * @return integer
     */
    public function getIntegerMax3()
    {
        return $this->integerMax3;
    }

    /**
     * Set integerMax4
     *
     * @param integer $integerMax4
     *
     * @return CategorySummary
     */
    public function setIntegerMax4($integerMax4)
    {
        $this->integerMax4 = $integerMax4;

        return $this;
    }

    /**
     * Get integerMax4
     *
     * @return integer
     */
    public function getIntegerMax4()
    {
        return $this->integerMax4;
    }

    /**
     * Set integerMax5
     *
     * @param integer $integerMax5
     *
     * @return CategorySummary
     */
    public function setIntegerMax5($integerMax5)
    {
        $this->integerMax5 = $integerMax5;

        return $this;
    }

    /**
     * Get integerMax5
     *
     * @return integer
     */
    public function getIntegerMax5()
    {
        return $this->integerMax5;
    }

    /**
     * Set integerMax6
     *
     * @param integer $integerMax6
     *
     * @return CategorySummary
     */
    public function setIntegerMax6($integerMax6)
    {
        $this->integerMax6 = $integerMax6;

        return $this;
    }

    /**
     * Get integerMax6
     *
     * @return integer
     */
    public function getIntegerMax6()
    {
        return $this->integerMax6;
    }

    /**
     * Set integerMax7
     *
     * @param integer $integerMax7
     *
     * @return CategorySummary
     */
    public function setIntegerMax7($integerMax7)
    {
        $this->integerMax7 = $integerMax7;

        return $this;
    }

    /**
     * Get integerMax7
     *
     * @return integer
     */
    public function getIntegerMax7()
    {
        return $this->integerMax7;
    }

    /**
     * Set integerMax8
     *
     * @param integer $integerMax8
     *
     * @return CategorySummary
     */
    public function setIntegerMax8($integerMax8)
    {
        $this->integerMax8 = $integerMax8;

        return $this;
    }

    /**
     * Get integerMax8
     *
     * @return integer
     */
    public function getIntegerMax8()
    {
        return $this->integerMax8;
    }

    /**
     * Set integerMax9
     *
     * @param integer $integerMax9
     *
     * @return CategorySummary
     */
    public function setIntegerMax9($integerMax9)
    {
        $this->integerMax9 = $integerMax9;

        return $this;
    }

    /**
     * Get integerMax9
     *
     * @return integer
     */
    public function getIntegerMax9()
    {
        return $this->integerMax9;
    }

    /**
     * Set integerMax10
     *
     * @param integer $integerMax10
     *
     * @return CategorySummary
     */
    public function setIntegerMax10($integerMax10)
    {
        $this->integerMax10 = $integerMax10;

        return $this;
    }

    /**
     * Get integerMax10
     *
     * @return integer
     */
    public function getIntegerMax10()
    {
        return $this->integerMax10;
    }

    /**
     * Set integerMax11
     *
     * @param integer $integerMax11
     *
     * @return CategorySummary
     */
    public function setIntegerMax11($integerMax11)
    {
        $this->integerMax11 = $integerMax11;

        return $this;
    }

    /**
     * Get integerMax11
     *
     * @return integer
     */
    public function getIntegerMax11()
    {
        return $this->integerMax11;
    }

    /**
     * Set integerMax12
     *
     * @param integer $integerMax12
     *
     * @return CategorySummary
     */
    public function setIntegerMax12($integerMax12)
    {
        $this->integerMax12 = $integerMax12;

        return $this;
    }

    /**
     * Get integerMax12
     *
     * @return integer
     */
    public function getIntegerMax12()
    {
        return $this->integerMax12;
    }

    /**
     * Set integerMax13
     *
     * @param integer $integerMax13
     *
     * @return CategorySummary
     */
    public function setIntegerMax13($integerMax13)
    {
        $this->integerMax13 = $integerMax13;

        return $this;
    }

    /**
     * Get integerMax13
     *
     * @return integer
     */
    public function getIntegerMax13()
    {
        return $this->integerMax13;
    }

    /**
     * Set integerMax14
     *
     * @param integer $integerMax14
     *
     * @return CategorySummary
     */
    public function setIntegerMax14($integerMax14)
    {
        $this->integerMax14 = $integerMax14;

        return $this;
    }

    /**
     * Get integerMax14
     *
     * @return integer
     */
    public function getIntegerMax14()
    {
        return $this->integerMax14;
    }

    /**
     * Set integerMax15
     *
     * @param integer $integerMax15
     *
     * @return CategorySummary
     */
    public function setIntegerMax15($integerMax15)
    {
        $this->integerMax15 = $integerMax15;

        return $this;
    }

    /**
     * Get integerMax15
     *
     * @return integer
     */
    public function getIntegerMax15()
    {
        return $this->integerMax15;
    }

    /**
     * Set integerMax16
     *
     * @param integer $integerMax16
     *
     * @return CategorySummary
     */
    public function setIntegerMax16($integerMax16)
    {
        $this->integerMax16 = $integerMax16;

        return $this;
    }

    /**
     * Get integerMax16
     *
     * @return integer
     */
    public function getIntegerMax16()
    {
        return $this->integerMax16;
    }

    /**
     * Set integerMax17
     *
     * @param integer $integerMax17
     *
     * @return CategorySummary
     */
    public function setIntegerMax17($integerMax17)
    {
        $this->integerMax17 = $integerMax17;

        return $this;
    }

    /**
     * Get integerMax17
     *
     * @return integer
     */
    public function getIntegerMax17()
    {
        return $this->integerMax17;
    }

    /**
     * Set integerMax18
     *
     * @param integer $integerMax18
     *
     * @return CategorySummary
     */
    public function setIntegerMax18($integerMax18)
    {
        $this->integerMax18 = $integerMax18;

        return $this;
    }

    /**
     * Get integerMax18
     *
     * @return integer
     */
    public function getIntegerMax18()
    {
        return $this->integerMax18;
    }

    /**
     * Set integerMax19
     *
     * @param integer $integerMax19
     *
     * @return CategorySummary
     */
    public function setIntegerMax19($integerMax19)
    {
        $this->integerMax19 = $integerMax19;

        return $this;
    }

    /**
     * Get integerMax19
     *
     * @return integer
     */
    public function getIntegerMax19()
    {
        return $this->integerMax19;
    }

    /**
     * Set integerMax20
     *
     * @param integer $integerMax20
     *
     * @return CategorySummary
     */
    public function setIntegerMax20($integerMax20)
    {
        $this->integerMax20 = $integerMax20;

        return $this;
    }

    /**
     * Get integerMax20
     *
     * @return integer
     */
    public function getIntegerMax20()
    {
        return $this->integerMax20;
    }

    /**
     * Set integerMax21
     *
     * @param integer $integerMax21
     *
     * @return CategorySummary
     */
    public function setIntegerMax21($integerMax21)
    {
        $this->integerMax21 = $integerMax21;

        return $this;
    }

    /**
     * Get integerMax21
     *
     * @return integer
     */
    public function getIntegerMax21()
    {
        return $this->integerMax21;
    }

    /**
     * Set integerMax22
     *
     * @param integer $integerMax22
     *
     * @return CategorySummary
     */
    public function setIntegerMax22($integerMax22)
    {
        $this->integerMax22 = $integerMax22;

        return $this;
    }

    /**
     * Get integerMax22
     *
     * @return integer
     */
    public function getIntegerMax22()
    {
        return $this->integerMax22;
    }

    /**
     * Set integerMax23
     *
     * @param integer $integerMax23
     *
     * @return CategorySummary
     */
    public function setIntegerMax23($integerMax23)
    {
        $this->integerMax23 = $integerMax23;

        return $this;
    }

    /**
     * Get integerMax23
     *
     * @return integer
     */
    public function getIntegerMax23()
    {
        return $this->integerMax23;
    }

    /**
     * Set integerMax24
     *
     * @param integer $integerMax24
     *
     * @return CategorySummary
     */
    public function setIntegerMax24($integerMax24)
    {
        $this->integerMax24 = $integerMax24;

        return $this;
    }

    /**
     * Get integerMax24
     *
     * @return integer
     */
    public function getIntegerMax24()
    {
        return $this->integerMax24;
    }

    /**
     * Set integerMax25
     *
     * @param integer $integerMax25
     *
     * @return CategorySummary
     */
    public function setIntegerMax25($integerMax25)
    {
        $this->integerMax25 = $integerMax25;

        return $this;
    }

    /**
     * Get integerMax25
     *
     * @return integer
     */
    public function getIntegerMax25()
    {
        return $this->integerMax25;
    }

    /**
     * Set integerMax26
     *
     * @param integer $integerMax26
     *
     * @return CategorySummary
     */
    public function setIntegerMax26($integerMax26)
    {
        $this->integerMax26 = $integerMax26;

        return $this;
    }

    /**
     * Get integerMax26
     *
     * @return integer
     */
    public function getIntegerMax26()
    {
        return $this->integerMax26;
    }

    /**
     * Set integerMax27
     *
     * @param integer $integerMax27
     *
     * @return CategorySummary
     */
    public function setIntegerMax27($integerMax27)
    {
        $this->integerMax27 = $integerMax27;

        return $this;
    }

    /**
     * Get integerMax27
     *
     * @return integer
     */
    public function getIntegerMax27()
    {
        return $this->integerMax27;
    }

    /**
     * Set integerMax28
     *
     * @param integer $integerMax28
     *
     * @return CategorySummary
     */
    public function setIntegerMax28($integerMax28)
    {
        $this->integerMax28 = $integerMax28;

        return $this;
    }

    /**
     * Get integerMax28
     *
     * @return integer
     */
    public function getIntegerMax28()
    {
        return $this->integerMax28;
    }

    /**
     * Set integerMax29
     *
     * @param integer $integerMax29
     *
     * @return CategorySummary
     */
    public function setIntegerMax29($integerMax29)
    {
        $this->integerMax29 = $integerMax29;

        return $this;
    }

    /**
     * Get integerMax29
     *
     * @return integer
     */
    public function getIntegerMax29()
    {
        return $this->integerMax29;
    }

    /**
     * Set integerMax30
     *
     * @param integer $integerMax30
     *
     * @return CategorySummary
     */
    public function setIntegerMax30($integerMax30)
    {
        $this->integerMax30 = $integerMax30;

        return $this;
    }

    /**
     * Get integerMax30
     *
     * @return integer
     */
    public function getIntegerMax30()
    {
        return $this->integerMax30;
    }

    /**
     * Set stringMin1
     *
     * @param integer $stringMin1
     *
     * @return CategorySummary
     */
    public function setStringMin1($stringMin1)
    {
        $this->stringMin1 = $stringMin1;

        return $this;
    }

    /**
     * Get stringMin1
     *
     * @return integer
     */
    public function getStringMin1()
    {
        return $this->stringMin1;
    }

    /**
     * Set stringMin2
     *
     * @param integer $stringMin2
     *
     * @return CategorySummary
     */
    public function setStringMin2($stringMin2)
    {
        $this->stringMin2 = $stringMin2;

        return $this;
    }

    /**
     * Get stringMin2
     *
     * @return integer
     */
    public function getStringMin2()
    {
        return $this->stringMin2;
    }

    /**
     * Set stringMin3
     *
     * @param integer $stringMin3
     *
     * @return CategorySummary
     */
    public function setStringMin3($stringMin3)
    {
        $this->stringMin3 = $stringMin3;

        return $this;
    }

    /**
     * Get stringMin3
     *
     * @return integer
     */
    public function getStringMin3()
    {
        return $this->stringMin3;
    }

    /**
     * Set stringMin4
     *
     * @param integer $stringMin4
     *
     * @return CategorySummary
     */
    public function setStringMin4($stringMin4)
    {
        $this->stringMin4 = $stringMin4;

        return $this;
    }

    /**
     * Get stringMin4
     *
     * @return integer
     */
    public function getStringMin4()
    {
        return $this->stringMin4;
    }

    /**
     * Set stringMin5
     *
     * @param integer $stringMin5
     *
     * @return CategorySummary
     */
    public function setStringMin5($stringMin5)
    {
        $this->stringMin5 = $stringMin5;

        return $this;
    }

    /**
     * Get stringMin5
     *
     * @return integer
     */
    public function getStringMin5()
    {
        return $this->stringMin5;
    }

    /**
     * Set stringMin6
     *
     * @param integer $stringMin6
     *
     * @return CategorySummary
     */
    public function setStringMin6($stringMin6)
    {
        $this->stringMin6 = $stringMin6;

        return $this;
    }

    /**
     * Get stringMin6
     *
     * @return integer
     */
    public function getStringMin6()
    {
        return $this->stringMin6;
    }

    /**
     * Set stringMin7
     *
     * @param integer $stringMin7
     *
     * @return CategorySummary
     */
    public function setStringMin7($stringMin7)
    {
        $this->stringMin7 = $stringMin7;

        return $this;
    }

    /**
     * Get stringMin7
     *
     * @return integer
     */
    public function getStringMin7()
    {
        return $this->stringMin7;
    }

    /**
     * Set stringMin8
     *
     * @param integer $stringMin8
     *
     * @return CategorySummary
     */
    public function setStringMin8($stringMin8)
    {
        $this->stringMin8 = $stringMin8;

        return $this;
    }

    /**
     * Get stringMin8
     *
     * @return integer
     */
    public function getStringMin8()
    {
        return $this->stringMin8;
    }

    /**
     * Set stringMin9
     *
     * @param integer $stringMin9
     *
     * @return CategorySummary
     */
    public function setStringMin9($stringMin9)
    {
        $this->stringMin9 = $stringMin9;

        return $this;
    }

    /**
     * Get stringMin9
     *
     * @return integer
     */
    public function getStringMin9()
    {
        return $this->stringMin9;
    }

    /**
     * Set stringMin10
     *
     * @param integer $stringMin10
     *
     * @return CategorySummary
     */
    public function setStringMin10($stringMin10)
    {
        $this->stringMin10 = $stringMin10;

        return $this;
    }

    /**
     * Get stringMin10
     *
     * @return integer
     */
    public function getStringMin10()
    {
        return $this->stringMin10;
    }

    /**
     * Set stringMin11
     *
     * @param integer $stringMin11
     *
     * @return CategorySummary
     */
    public function setStringMin11($stringMin11)
    {
        $this->stringMin11 = $stringMin11;

        return $this;
    }

    /**
     * Get stringMin11
     *
     * @return integer
     */
    public function getStringMin11()
    {
        return $this->stringMin11;
    }

    /**
     * Set stringMin12
     *
     * @param integer $stringMin12
     *
     * @return CategorySummary
     */
    public function setStringMin12($stringMin12)
    {
        $this->stringMin12 = $stringMin12;

        return $this;
    }

    /**
     * Get stringMin12
     *
     * @return integer
     */
    public function getStringMin12()
    {
        return $this->stringMin12;
    }

    /**
     * Set stringMin13
     *
     * @param integer $stringMin13
     *
     * @return CategorySummary
     */
    public function setStringMin13($stringMin13)
    {
        $this->stringMin13 = $stringMin13;

        return $this;
    }

    /**
     * Get stringMin13
     *
     * @return integer
     */
    public function getStringMin13()
    {
        return $this->stringMin13;
    }

    /**
     * Set stringMin14
     *
     * @param integer $stringMin14
     *
     * @return CategorySummary
     */
    public function setStringMin14($stringMin14)
    {
        $this->stringMin14 = $stringMin14;

        return $this;
    }

    /**
     * Get stringMin14
     *
     * @return integer
     */
    public function getStringMin14()
    {
        return $this->stringMin14;
    }

    /**
     * Set stringMin15
     *
     * @param integer $stringMin15
     *
     * @return CategorySummary
     */
    public function setStringMin15($stringMin15)
    {
        $this->stringMin15 = $stringMin15;

        return $this;
    }

    /**
     * Get stringMin15
     *
     * @return integer
     */
    public function getStringMin15()
    {
        return $this->stringMin15;
    }

    /**
     * Set stringMin16
     *
     * @param integer $stringMin16
     *
     * @return CategorySummary
     */
    public function setStringMin16($stringMin16)
    {
        $this->stringMin16 = $stringMin16;

        return $this;
    }

    /**
     * Get stringMin16
     *
     * @return integer
     */
    public function getStringMin16()
    {
        return $this->stringMin16;
    }

    /**
     * Set stringMin17
     *
     * @param integer $stringMin17
     *
     * @return CategorySummary
     */
    public function setStringMin17($stringMin17)
    {
        $this->stringMin17 = $stringMin17;

        return $this;
    }

    /**
     * Get stringMin17
     *
     * @return integer
     */
    public function getStringMin17()
    {
        return $this->stringMin17;
    }

    /**
     * Set stringMin18
     *
     * @param integer $stringMin18
     *
     * @return CategorySummary
     */
    public function setStringMin18($stringMin18)
    {
        $this->stringMin18 = $stringMin18;

        return $this;
    }

    /**
     * Get stringMin18
     *
     * @return integer
     */
    public function getStringMin18()
    {
        return $this->stringMin18;
    }

    /**
     * Set stringMin19
     *
     * @param integer $stringMin19
     *
     * @return CategorySummary
     */
    public function setStringMin19($stringMin19)
    {
        $this->stringMin19 = $stringMin19;

        return $this;
    }

    /**
     * Get stringMin19
     *
     * @return integer
     */
    public function getStringMin19()
    {
        return $this->stringMin19;
    }

    /**
     * Set stringMin20
     *
     * @param integer $stringMin20
     *
     * @return CategorySummary
     */
    public function setStringMin20($stringMin20)
    {
        $this->stringMin20 = $stringMin20;

        return $this;
    }

    /**
     * Get stringMin20
     *
     * @return integer
     */
    public function getStringMin20()
    {
        return $this->stringMin20;
    }

    /**
     * Set stringMin21
     *
     * @param integer $stringMin21
     *
     * @return CategorySummary
     */
    public function setStringMin21($stringMin21)
    {
        $this->stringMin21 = $stringMin21;

        return $this;
    }

    /**
     * Get stringMin21
     *
     * @return integer
     */
    public function getStringMin21()
    {
        return $this->stringMin21;
    }

    /**
     * Set stringMin22
     *
     * @param integer $stringMin22
     *
     * @return CategorySummary
     */
    public function setStringMin22($stringMin22)
    {
        $this->stringMin22 = $stringMin22;

        return $this;
    }

    /**
     * Get stringMin22
     *
     * @return integer
     */
    public function getStringMin22()
    {
        return $this->stringMin22;
    }

    /**
     * Set stringMin23
     *
     * @param integer $stringMin23
     *
     * @return CategorySummary
     */
    public function setStringMin23($stringMin23)
    {
        $this->stringMin23 = $stringMin23;

        return $this;
    }

    /**
     * Get stringMin23
     *
     * @return integer
     */
    public function getStringMin23()
    {
        return $this->stringMin23;
    }

    /**
     * Set stringMin24
     *
     * @param integer $stringMin24
     *
     * @return CategorySummary
     */
    public function setStringMin24($stringMin24)
    {
        $this->stringMin24 = $stringMin24;

        return $this;
    }

    /**
     * Get stringMin24
     *
     * @return integer
     */
    public function getStringMin24()
    {
        return $this->stringMin24;
    }

    /**
     * Set stringMin25
     *
     * @param integer $stringMin25
     *
     * @return CategorySummary
     */
    public function setStringMin25($stringMin25)
    {
        $this->stringMin25 = $stringMin25;

        return $this;
    }

    /**
     * Get stringMin25
     *
     * @return integer
     */
    public function getStringMin25()
    {
        return $this->stringMin25;
    }

    /**
     * Set stringMin26
     *
     * @param integer $stringMin26
     *
     * @return CategorySummary
     */
    public function setStringMin26($stringMin26)
    {
        $this->stringMin26 = $stringMin26;

        return $this;
    }

    /**
     * Get stringMin26
     *
     * @return integer
     */
    public function getStringMin26()
    {
        return $this->stringMin26;
    }

    /**
     * Set stringMin27
     *
     * @param integer $stringMin27
     *
     * @return CategorySummary
     */
    public function setStringMin27($stringMin27)
    {
        $this->stringMin27 = $stringMin27;

        return $this;
    }

    /**
     * Get stringMin27
     *
     * @return integer
     */
    public function getStringMin27()
    {
        return $this->stringMin27;
    }

    /**
     * Set stringMin28
     *
     * @param integer $stringMin28
     *
     * @return CategorySummary
     */
    public function setStringMin28($stringMin28)
    {
        $this->stringMin28 = $stringMin28;

        return $this;
    }

    /**
     * Get stringMin28
     *
     * @return integer
     */
    public function getStringMin28()
    {
        return $this->stringMin28;
    }

    /**
     * Set stringMin29
     *
     * @param integer $stringMin29
     *
     * @return CategorySummary
     */
    public function setStringMin29($stringMin29)
    {
        $this->stringMin29 = $stringMin29;

        return $this;
    }

    /**
     * Get stringMin29
     *
     * @return integer
     */
    public function getStringMin29()
    {
        return $this->stringMin29;
    }

    /**
     * Set stringMin30
     *
     * @param integer $stringMin30
     *
     * @return CategorySummary
     */
    public function setStringMin30($stringMin30)
    {
        $this->stringMin30 = $stringMin30;

        return $this;
    }

    /**
     * Get stringMin30
     *
     * @return integer
     */
    public function getStringMin30()
    {
        return $this->stringMin30;
    }

    /**
     * Set stringMax1
     *
     * @param integer $stringMax1
     *
     * @return CategorySummary
     */
    public function setStringMax1($stringMax1)
    {
        $this->stringMax1 = $stringMax1;

        return $this;
    }

    /**
     * Get stringMax1
     *
     * @return integer
     */
    public function getStringMax1()
    {
        return $this->stringMax1;
    }

    /**
     * Set stringMax2
     *
     * @param integer $stringMax2
     *
     * @return CategorySummary
     */
    public function setStringMax2($stringMax2)
    {
        $this->stringMax2 = $stringMax2;

        return $this;
    }

    /**
     * Get stringMax2
     *
     * @return integer
     */
    public function getStringMax2()
    {
        return $this->stringMax2;
    }

    /**
     * Set stringMax3
     *
     * @param integer $stringMax3
     *
     * @return CategorySummary
     */
    public function setStringMax3($stringMax3)
    {
        $this->stringMax3 = $stringMax3;

        return $this;
    }

    /**
     * Get stringMax3
     *
     * @return integer
     */
    public function getStringMax3()
    {
        return $this->stringMax3;
    }

    /**
     * Set stringMax4
     *
     * @param integer $stringMax4
     *
     * @return CategorySummary
     */
    public function setStringMax4($stringMax4)
    {
        $this->stringMax4 = $stringMax4;

        return $this;
    }

    /**
     * Get stringMax4
     *
     * @return integer
     */
    public function getStringMax4()
    {
        return $this->stringMax4;
    }

    /**
     * Set stringMax5
     *
     * @param integer $stringMax5
     *
     * @return CategorySummary
     */
    public function setStringMax5($stringMax5)
    {
        $this->stringMax5 = $stringMax5;

        return $this;
    }

    /**
     * Get stringMax5
     *
     * @return integer
     */
    public function getStringMax5()
    {
        return $this->stringMax5;
    }

    /**
     * Set stringMax6
     *
     * @param integer $stringMax6
     *
     * @return CategorySummary
     */
    public function setStringMax6($stringMax6)
    {
        $this->stringMax6 = $stringMax6;

        return $this;
    }

    /**
     * Get stringMax6
     *
     * @return integer
     */
    public function getStringMax6()
    {
        return $this->stringMax6;
    }

    /**
     * Set stringMax7
     *
     * @param integer $stringMax7
     *
     * @return CategorySummary
     */
    public function setStringMax7($stringMax7)
    {
        $this->stringMax7 = $stringMax7;

        return $this;
    }

    /**
     * Get stringMax7
     *
     * @return integer
     */
    public function getStringMax7()
    {
        return $this->stringMax7;
    }

    /**
     * Set stringMax8
     *
     * @param integer $stringMax8
     *
     * @return CategorySummary
     */
    public function setStringMax8($stringMax8)
    {
        $this->stringMax8 = $stringMax8;

        return $this;
    }

    /**
     * Get stringMax8
     *
     * @return integer
     */
    public function getStringMax8()
    {
        return $this->stringMax8;
    }

    /**
     * Set stringMax9
     *
     * @param integer $stringMax9
     *
     * @return CategorySummary
     */
    public function setStringMax9($stringMax9)
    {
        $this->stringMax9 = $stringMax9;

        return $this;
    }

    /**
     * Get stringMax9
     *
     * @return integer
     */
    public function getStringMax9()
    {
        return $this->stringMax9;
    }

    /**
     * Set stringMax10
     *
     * @param integer $stringMax10
     *
     * @return CategorySummary
     */
    public function setStringMax10($stringMax10)
    {
        $this->stringMax10 = $stringMax10;

        return $this;
    }

    /**
     * Get stringMax10
     *
     * @return integer
     */
    public function getStringMax10()
    {
        return $this->stringMax10;
    }

    /**
     * Set stringMax11
     *
     * @param integer $stringMax11
     *
     * @return CategorySummary
     */
    public function setStringMax11($stringMax11)
    {
        $this->stringMax11 = $stringMax11;

        return $this;
    }

    /**
     * Get stringMax11
     *
     * @return integer
     */
    public function getStringMax11()
    {
        return $this->stringMax11;
    }

    /**
     * Set stringMax12
     *
     * @param integer $stringMax12
     *
     * @return CategorySummary
     */
    public function setStringMax12($stringMax12)
    {
        $this->stringMax12 = $stringMax12;

        return $this;
    }

    /**
     * Get stringMax12
     *
     * @return integer
     */
    public function getStringMax12()
    {
        return $this->stringMax12;
    }

    /**
     * Set stringMax13
     *
     * @param integer $stringMax13
     *
     * @return CategorySummary
     */
    public function setStringMax13($stringMax13)
    {
        $this->stringMax13 = $stringMax13;

        return $this;
    }

    /**
     * Get stringMax13
     *
     * @return integer
     */
    public function getStringMax13()
    {
        return $this->stringMax13;
    }

    /**
     * Set stringMax14
     *
     * @param integer $stringMax14
     *
     * @return CategorySummary
     */
    public function setStringMax14($stringMax14)
    {
        $this->stringMax14 = $stringMax14;

        return $this;
    }

    /**
     * Get stringMax14
     *
     * @return integer
     */
    public function getStringMax14()
    {
        return $this->stringMax14;
    }

    /**
     * Set stringMax15
     *
     * @param integer $stringMax15
     *
     * @return CategorySummary
     */
    public function setStringMax15($stringMax15)
    {
        $this->stringMax15 = $stringMax15;

        return $this;
    }

    /**
     * Get stringMax15
     *
     * @return integer
     */
    public function getStringMax15()
    {
        return $this->stringMax15;
    }

    /**
     * Set stringMax16
     *
     * @param integer $stringMax16
     *
     * @return CategorySummary
     */
    public function setStringMax16($stringMax16)
    {
        $this->stringMax16 = $stringMax16;

        return $this;
    }

    /**
     * Get stringMax16
     *
     * @return integer
     */
    public function getStringMax16()
    {
        return $this->stringMax16;
    }

    /**
     * Set stringMax17
     *
     * @param integer $stringMax17
     *
     * @return CategorySummary
     */
    public function setStringMax17($stringMax17)
    {
        $this->stringMax17 = $stringMax17;

        return $this;
    }

    /**
     * Get stringMax17
     *
     * @return integer
     */
    public function getStringMax17()
    {
        return $this->stringMax17;
    }

    /**
     * Set stringMax18
     *
     * @param integer $stringMax18
     *
     * @return CategorySummary
     */
    public function setStringMax18($stringMax18)
    {
        $this->stringMax18 = $stringMax18;

        return $this;
    }

    /**
     * Get stringMax18
     *
     * @return integer
     */
    public function getStringMax18()
    {
        return $this->stringMax18;
    }

    /**
     * Set stringMax19
     *
     * @param integer $stringMax19
     *
     * @return CategorySummary
     */
    public function setStringMax19($stringMax19)
    {
        $this->stringMax19 = $stringMax19;

        return $this;
    }

    /**
     * Get stringMax19
     *
     * @return integer
     */
    public function getStringMax19()
    {
        return $this->stringMax19;
    }

    /**
     * Set stringMax20
     *
     * @param integer $stringMax20
     *
     * @return CategorySummary
     */
    public function setStringMax20($stringMax20)
    {
        $this->stringMax20 = $stringMax20;

        return $this;
    }

    /**
     * Get stringMax20
     *
     * @return integer
     */
    public function getStringMax20()
    {
        return $this->stringMax20;
    }

    /**
     * Set stringMax21
     *
     * @param integer $stringMax21
     *
     * @return CategorySummary
     */
    public function setStringMax21($stringMax21)
    {
        $this->stringMax21 = $stringMax21;

        return $this;
    }

    /**
     * Get stringMax21
     *
     * @return integer
     */
    public function getStringMax21()
    {
        return $this->stringMax21;
    }

    /**
     * Set stringMax22
     *
     * @param integer $stringMax22
     *
     * @return CategorySummary
     */
    public function setStringMax22($stringMax22)
    {
        $this->stringMax22 = $stringMax22;

        return $this;
    }

    /**
     * Get stringMax22
     *
     * @return integer
     */
    public function getStringMax22()
    {
        return $this->stringMax22;
    }

    /**
     * Set stringMax23
     *
     * @param integer $stringMax23
     *
     * @return CategorySummary
     */
    public function setStringMax23($stringMax23)
    {
        $this->stringMax23 = $stringMax23;

        return $this;
    }

    /**
     * Get stringMax23
     *
     * @return integer
     */
    public function getStringMax23()
    {
        return $this->stringMax23;
    }

    /**
     * Set stringMax24
     *
     * @param integer $stringMax24
     *
     * @return CategorySummary
     */
    public function setStringMax24($stringMax24)
    {
        $this->stringMax24 = $stringMax24;

        return $this;
    }

    /**
     * Get stringMax24
     *
     * @return integer
     */
    public function getStringMax24()
    {
        return $this->stringMax24;
    }

    /**
     * Set stringMax25
     *
     * @param integer $stringMax25
     *
     * @return CategorySummary
     */
    public function setStringMax25($stringMax25)
    {
        $this->stringMax25 = $stringMax25;

        return $this;
    }

    /**
     * Get stringMax25
     *
     * @return integer
     */
    public function getStringMax25()
    {
        return $this->stringMax25;
    }

    /**
     * Set stringMax26
     *
     * @param integer $stringMax26
     *
     * @return CategorySummary
     */
    public function setStringMax26($stringMax26)
    {
        $this->stringMax26 = $stringMax26;

        return $this;
    }

    /**
     * Get stringMax26
     *
     * @return integer
     */
    public function getStringMax26()
    {
        return $this->stringMax26;
    }

    /**
     * Set stringMax27
     *
     * @param integer $stringMax27
     *
     * @return CategorySummary
     */
    public function setStringMax27($stringMax27)
    {
        $this->stringMax27 = $stringMax27;

        return $this;
    }

    /**
     * Get stringMax27
     *
     * @return integer
     */
    public function getStringMax27()
    {
        return $this->stringMax27;
    }

    /**
     * Set stringMax28
     *
     * @param integer $stringMax28
     *
     * @return CategorySummary
     */
    public function setStringMax28($stringMax28)
    {
        $this->stringMax28 = $stringMax28;

        return $this;
    }

    /**
     * Get stringMax28
     *
     * @return integer
     */
    public function getStringMax28()
    {
        return $this->stringMax28;
    }

    /**
     * Set stringMax29
     *
     * @param integer $stringMax29
     *
     * @return CategorySummary
     */
    public function setStringMax29($stringMax29)
    {
        $this->stringMax29 = $stringMax29;

        return $this;
    }

    /**
     * Get stringMax29
     *
     * @return integer
     */
    public function getStringMax29()
    {
        return $this->stringMax29;
    }

    /**
     * Set stringMax30
     *
     * @param integer $stringMax30
     *
     * @return CategorySummary
     */
    public function setStringMax30($stringMax30)
    {
        $this->stringMax30 = $stringMax30;

        return $this;
    }

    /**
     * Get stringMax30
     *
     * @return integer
     */
    public function getStringMax30()
    {
        return $this->stringMax30;
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
     * @return CategorySummary
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
