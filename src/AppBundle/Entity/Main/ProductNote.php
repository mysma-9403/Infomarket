<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Simple;

class ProductNote extends Simple {

	public function offsetExists($offset) {
		if (strpos($offset, 'decimalNote') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integerNote') !== false) {
			return true;
		}
		
		if (strpos($offset, 'stringNote') !== false) {
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
    private $overalNote;

    /**
     * @var string
     */
    private $decimalNote1;

    /**
     * @var string
     */
    private $decimalNote2;

    /**
     * @var string
     */
    private $decimalNote3;

    /**
     * @var string
     */
    private $decimalNote4;

    /**
     * @var string
     */
    private $decimalNote5;

    /**
     * @var string
     */
    private $decimalNote6;

    /**
     * @var string
     */
    private $decimalNote7;

    /**
     * @var string
     */
    private $decimalNote8;

    /**
     * @var string
     */
    private $decimalNote9;

    /**
     * @var string
     */
    private $decimalNote10;

    /**
     * @var string
     */
    private $decimalNote11;

    /**
     * @var string
     */
    private $decimalNote12;

    /**
     * @var string
     */
    private $decimalNote13;

    /**
     * @var string
     */
    private $decimalNote14;

    /**
     * @var string
     */
    private $decimalNote15;

    /**
     * @var string
     */
    private $decimalNote16;

    /**
     * @var string
     */
    private $decimalNote17;

    /**
     * @var string
     */
    private $decimalNote18;

    /**
     * @var string
     */
    private $decimalNote19;

    /**
     * @var string
     */
    private $decimalNote20;

    /**
     * @var string
     */
    private $decimalNote21;

    /**
     * @var string
     */
    private $decimalNote22;

    /**
     * @var string
     */
    private $decimalNote23;

    /**
     * @var string
     */
    private $decimalNote24;

    /**
     * @var string
     */
    private $decimalNote25;

    /**
     * @var string
     */
    private $decimalNote26;

    /**
     * @var string
     */
    private $decimalNote27;

    /**
     * @var string
     */
    private $decimalNote28;

    /**
     * @var string
     */
    private $decimalNote29;

    /**
     * @var string
     */
    private $decimalNote30;

    /**
     * @var string
     */
    private $integerNote1;

    /**
     * @var string
     */
    private $integerNote2;

    /**
     * @var string
     */
    private $integerNote3;

    /**
     * @var string
     */
    private $integerNote4;

    /**
     * @var string
     */
    private $integerNote5;

    /**
     * @var string
     */
    private $integerNote6;

    /**
     * @var string
     */
    private $integerNote7;

    /**
     * @var string
     */
    private $integerNote8;

    /**
     * @var string
     */
    private $integerNote9;

    /**
     * @var string
     */
    private $integerNote10;

    /**
     * @var string
     */
    private $integerNote11;

    /**
     * @var string
     */
    private $integerNote12;

    /**
     * @var string
     */
    private $integerNote13;

    /**
     * @var string
     */
    private $integerNote14;

    /**
     * @var string
     */
    private $integerNote15;

    /**
     * @var string
     */
    private $integerNote16;

    /**
     * @var string
     */
    private $integerNote17;

    /**
     * @var string
     */
    private $integerNote18;

    /**
     * @var string
     */
    private $integerNote19;

    /**
     * @var string
     */
    private $integerNote20;

    /**
     * @var string
     */
    private $integerNote21;

    /**
     * @var string
     */
    private $integerNote22;

    /**
     * @var string
     */
    private $integerNote23;

    /**
     * @var string
     */
    private $integerNote24;

    /**
     * @var string
     */
    private $integerNote25;

    /**
     * @var string
     */
    private $integerNote26;

    /**
     * @var string
     */
    private $integerNote27;

    /**
     * @var string
     */
    private $integerNote28;

    /**
     * @var string
     */
    private $integerNote29;

    /**
     * @var string
     */
    private $integerNote30;

    /**
     * @var string
     */
    private $stringNote1;

    /**
     * @var string
     */
    private $stringNote2;

    /**
     * @var string
     */
    private $stringNote3;

    /**
     * @var string
     */
    private $stringNote4;

    /**
     * @var string
     */
    private $stringNote5;

    /**
     * @var string
     */
    private $stringNote6;

    /**
     * @var string
     */
    private $stringNote7;

    /**
     * @var string
     */
    private $stringNote8;

    /**
     * @var string
     */
    private $stringNote9;

    /**
     * @var string
     */
    private $stringNote10;

    /**
     * @var string
     */
    private $stringNote11;

    /**
     * @var string
     */
    private $stringNote12;

    /**
     * @var string
     */
    private $stringNote13;

    /**
     * @var string
     */
    private $stringNote14;

    /**
     * @var string
     */
    private $stringNote15;

    /**
     * @var string
     */
    private $stringNote16;

    /**
     * @var string
     */
    private $stringNote17;

    /**
     * @var string
     */
    private $stringNote18;

    /**
     * @var string
     */
    private $stringNote19;

    /**
     * @var string
     */
    private $stringNote20;

    /**
     * @var string
     */
    private $stringNote21;

    /**
     * @var string
     */
    private $stringNote22;

    /**
     * @var string
     */
    private $stringNote23;

    /**
     * @var string
     */
    private $stringNote24;

    /**
     * @var string
     */
    private $stringNote25;

    /**
     * @var string
     */
    private $stringNote26;

    /**
     * @var string
     */
    private $stringNote27;

    /**
     * @var string
     */
    private $stringNote28;

    /**
     * @var string
     */
    private $stringNote29;

    /**
     * @var string
     */
    private $stringNote30;

    /**
     * @var \AppBundle\Entity\Assignments\ProductCategoryAssignment
     */
    private $productCategoryAssignment;


    /**
     * Set upToDate
     *
     * @param boolean $upToDate
     *
     * @return ProductNote
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
     * Set overalNote
     *
     * @param string $overalNote
     *
     * @return ProductNote
     */
    public function setOveralNote($overalNote)
    {
        $this->overalNote = $overalNote;

        return $this;
    }

    /**
     * Get overalNote
     *
     * @return string
     */
    public function getOveralNote()
    {
        return $this->overalNote;
    }

    /**
     * Set decimalNote1
     *
     * @param string $decimalNote1
     *
     * @return ProductNote
     */
    public function setDecimalNote1($decimalNote1)
    {
        $this->decimalNote1 = $decimalNote1;

        return $this;
    }

    /**
     * Get decimalNote1
     *
     * @return string
     */
    public function getDecimalNote1()
    {
        return $this->decimalNote1;
    }

    /**
     * Set decimalNote2
     *
     * @param string $decimalNote2
     *
     * @return ProductNote
     */
    public function setDecimalNote2($decimalNote2)
    {
        $this->decimalNote2 = $decimalNote2;

        return $this;
    }

    /**
     * Get decimalNote2
     *
     * @return string
     */
    public function getDecimalNote2()
    {
        return $this->decimalNote2;
    }

    /**
     * Set decimalNote3
     *
     * @param string $decimalNote3
     *
     * @return ProductNote
     */
    public function setDecimalNote3($decimalNote3)
    {
        $this->decimalNote3 = $decimalNote3;

        return $this;
    }

    /**
     * Get decimalNote3
     *
     * @return string
     */
    public function getDecimalNote3()
    {
        return $this->decimalNote3;
    }

    /**
     * Set decimalNote4
     *
     * @param string $decimalNote4
     *
     * @return ProductNote
     */
    public function setDecimalNote4($decimalNote4)
    {
        $this->decimalNote4 = $decimalNote4;

        return $this;
    }

    /**
     * Get decimalNote4
     *
     * @return string
     */
    public function getDecimalNote4()
    {
        return $this->decimalNote4;
    }

    /**
     * Set decimalNote5
     *
     * @param string $decimalNote5
     *
     * @return ProductNote
     */
    public function setDecimalNote5($decimalNote5)
    {
        $this->decimalNote5 = $decimalNote5;

        return $this;
    }

    /**
     * Get decimalNote5
     *
     * @return string
     */
    public function getDecimalNote5()
    {
        return $this->decimalNote5;
    }

    /**
     * Set decimalNote6
     *
     * @param string $decimalNote6
     *
     * @return ProductNote
     */
    public function setDecimalNote6($decimalNote6)
    {
        $this->decimalNote6 = $decimalNote6;

        return $this;
    }

    /**
     * Get decimalNote6
     *
     * @return string
     */
    public function getDecimalNote6()
    {
        return $this->decimalNote6;
    }

    /**
     * Set decimalNote7
     *
     * @param string $decimalNote7
     *
     * @return ProductNote
     */
    public function setDecimalNote7($decimalNote7)
    {
        $this->decimalNote7 = $decimalNote7;

        return $this;
    }

    /**
     * Get decimalNote7
     *
     * @return string
     */
    public function getDecimalNote7()
    {
        return $this->decimalNote7;
    }

    /**
     * Set decimalNote8
     *
     * @param string $decimalNote8
     *
     * @return ProductNote
     */
    public function setDecimalNote8($decimalNote8)
    {
        $this->decimalNote8 = $decimalNote8;

        return $this;
    }

    /**
     * Get decimalNote8
     *
     * @return string
     */
    public function getDecimalNote8()
    {
        return $this->decimalNote8;
    }

    /**
     * Set decimalNote9
     *
     * @param string $decimalNote9
     *
     * @return ProductNote
     */
    public function setDecimalNote9($decimalNote9)
    {
        $this->decimalNote9 = $decimalNote9;

        return $this;
    }

    /**
     * Get decimalNote9
     *
     * @return string
     */
    public function getDecimalNote9()
    {
        return $this->decimalNote9;
    }

    /**
     * Set decimalNote10
     *
     * @param string $decimalNote10
     *
     * @return ProductNote
     */
    public function setDecimalNote10($decimalNote10)
    {
        $this->decimalNote10 = $decimalNote10;

        return $this;
    }

    /**
     * Get decimalNote10
     *
     * @return string
     */
    public function getDecimalNote10()
    {
        return $this->decimalNote10;
    }

    /**
     * Set decimalNote11
     *
     * @param string $decimalNote11
     *
     * @return ProductNote
     */
    public function setDecimalNote11($decimalNote11)
    {
        $this->decimalNote11 = $decimalNote11;

        return $this;
    }

    /**
     * Get decimalNote11
     *
     * @return string
     */
    public function getDecimalNote11()
    {
        return $this->decimalNote11;
    }

    /**
     * Set decimalNote12
     *
     * @param string $decimalNote12
     *
     * @return ProductNote
     */
    public function setDecimalNote12($decimalNote12)
    {
        $this->decimalNote12 = $decimalNote12;

        return $this;
    }

    /**
     * Get decimalNote12
     *
     * @return string
     */
    public function getDecimalNote12()
    {
        return $this->decimalNote12;
    }

    /**
     * Set decimalNote13
     *
     * @param string $decimalNote13
     *
     * @return ProductNote
     */
    public function setDecimalNote13($decimalNote13)
    {
        $this->decimalNote13 = $decimalNote13;

        return $this;
    }

    /**
     * Get decimalNote13
     *
     * @return string
     */
    public function getDecimalNote13()
    {
        return $this->decimalNote13;
    }

    /**
     * Set decimalNote14
     *
     * @param string $decimalNote14
     *
     * @return ProductNote
     */
    public function setDecimalNote14($decimalNote14)
    {
        $this->decimalNote14 = $decimalNote14;

        return $this;
    }

    /**
     * Get decimalNote14
     *
     * @return string
     */
    public function getDecimalNote14()
    {
        return $this->decimalNote14;
    }

    /**
     * Set decimalNote15
     *
     * @param string $decimalNote15
     *
     * @return ProductNote
     */
    public function setDecimalNote15($decimalNote15)
    {
        $this->decimalNote15 = $decimalNote15;

        return $this;
    }

    /**
     * Get decimalNote15
     *
     * @return string
     */
    public function getDecimalNote15()
    {
        return $this->decimalNote15;
    }

    /**
     * Set decimalNote16
     *
     * @param string $decimalNote16
     *
     * @return ProductNote
     */
    public function setDecimalNote16($decimalNote16)
    {
        $this->decimalNote16 = $decimalNote16;

        return $this;
    }

    /**
     * Get decimalNote16
     *
     * @return string
     */
    public function getDecimalNote16()
    {
        return $this->decimalNote16;
    }

    /**
     * Set decimalNote17
     *
     * @param string $decimalNote17
     *
     * @return ProductNote
     */
    public function setDecimalNote17($decimalNote17)
    {
        $this->decimalNote17 = $decimalNote17;

        return $this;
    }

    /**
     * Get decimalNote17
     *
     * @return string
     */
    public function getDecimalNote17()
    {
        return $this->decimalNote17;
    }

    /**
     * Set decimalNote18
     *
     * @param string $decimalNote18
     *
     * @return ProductNote
     */
    public function setDecimalNote18($decimalNote18)
    {
        $this->decimalNote18 = $decimalNote18;

        return $this;
    }

    /**
     * Get decimalNote18
     *
     * @return string
     */
    public function getDecimalNote18()
    {
        return $this->decimalNote18;
    }

    /**
     * Set decimalNote19
     *
     * @param string $decimalNote19
     *
     * @return ProductNote
     */
    public function setDecimalNote19($decimalNote19)
    {
        $this->decimalNote19 = $decimalNote19;

        return $this;
    }

    /**
     * Get decimalNote19
     *
     * @return string
     */
    public function getDecimalNote19()
    {
        return $this->decimalNote19;
    }

    /**
     * Set decimalNote20
     *
     * @param string $decimalNote20
     *
     * @return ProductNote
     */
    public function setDecimalNote20($decimalNote20)
    {
        $this->decimalNote20 = $decimalNote20;

        return $this;
    }

    /**
     * Get decimalNote20
     *
     * @return string
     */
    public function getDecimalNote20()
    {
        return $this->decimalNote20;
    }

    /**
     * Set decimalNote21
     *
     * @param string $decimalNote21
     *
     * @return ProductNote
     */
    public function setDecimalNote21($decimalNote21)
    {
        $this->decimalNote21 = $decimalNote21;

        return $this;
    }

    /**
     * Get decimalNote21
     *
     * @return string
     */
    public function getDecimalNote21()
    {
        return $this->decimalNote21;
    }

    /**
     * Set decimalNote22
     *
     * @param string $decimalNote22
     *
     * @return ProductNote
     */
    public function setDecimalNote22($decimalNote22)
    {
        $this->decimalNote22 = $decimalNote22;

        return $this;
    }

    /**
     * Get decimalNote22
     *
     * @return string
     */
    public function getDecimalNote22()
    {
        return $this->decimalNote22;
    }

    /**
     * Set decimalNote23
     *
     * @param string $decimalNote23
     *
     * @return ProductNote
     */
    public function setDecimalNote23($decimalNote23)
    {
        $this->decimalNote23 = $decimalNote23;

        return $this;
    }

    /**
     * Get decimalNote23
     *
     * @return string
     */
    public function getDecimalNote23()
    {
        return $this->decimalNote23;
    }

    /**
     * Set decimalNote24
     *
     * @param string $decimalNote24
     *
     * @return ProductNote
     */
    public function setDecimalNote24($decimalNote24)
    {
        $this->decimalNote24 = $decimalNote24;

        return $this;
    }

    /**
     * Get decimalNote24
     *
     * @return string
     */
    public function getDecimalNote24()
    {
        return $this->decimalNote24;
    }

    /**
     * Set decimalNote25
     *
     * @param string $decimalNote25
     *
     * @return ProductNote
     */
    public function setDecimalNote25($decimalNote25)
    {
        $this->decimalNote25 = $decimalNote25;

        return $this;
    }

    /**
     * Get decimalNote25
     *
     * @return string
     */
    public function getDecimalNote25()
    {
        return $this->decimalNote25;
    }

    /**
     * Set decimalNote26
     *
     * @param string $decimalNote26
     *
     * @return ProductNote
     */
    public function setDecimalNote26($decimalNote26)
    {
        $this->decimalNote26 = $decimalNote26;

        return $this;
    }

    /**
     * Get decimalNote26
     *
     * @return string
     */
    public function getDecimalNote26()
    {
        return $this->decimalNote26;
    }

    /**
     * Set decimalNote27
     *
     * @param string $decimalNote27
     *
     * @return ProductNote
     */
    public function setDecimalNote27($decimalNote27)
    {
        $this->decimalNote27 = $decimalNote27;

        return $this;
    }

    /**
     * Get decimalNote27
     *
     * @return string
     */
    public function getDecimalNote27()
    {
        return $this->decimalNote27;
    }

    /**
     * Set decimalNote28
     *
     * @param string $decimalNote28
     *
     * @return ProductNote
     */
    public function setDecimalNote28($decimalNote28)
    {
        $this->decimalNote28 = $decimalNote28;

        return $this;
    }

    /**
     * Get decimalNote28
     *
     * @return string
     */
    public function getDecimalNote28()
    {
        return $this->decimalNote28;
    }

    /**
     * Set decimalNote29
     *
     * @param string $decimalNote29
     *
     * @return ProductNote
     */
    public function setDecimalNote29($decimalNote29)
    {
        $this->decimalNote29 = $decimalNote29;

        return $this;
    }

    /**
     * Get decimalNote29
     *
     * @return string
     */
    public function getDecimalNote29()
    {
        return $this->decimalNote29;
    }

    /**
     * Set decimalNote30
     *
     * @param string $decimalNote30
     *
     * @return ProductNote
     */
    public function setDecimalNote30($decimalNote30)
    {
        $this->decimalNote30 = $decimalNote30;

        return $this;
    }

    /**
     * Get decimalNote30
     *
     * @return string
     */
    public function getDecimalNote30()
    {
        return $this->decimalNote30;
    }

    /**
     * Set integerNote1
     *
     * @param string $integerNote1
     *
     * @return ProductNote
     */
    public function setIntegerNote1($integerNote1)
    {
        $this->integerNote1 = $integerNote1;

        return $this;
    }

    /**
     * Get integerNote1
     *
     * @return string
     */
    public function getIntegerNote1()
    {
        return $this->integerNote1;
    }

    /**
     * Set integerNote2
     *
     * @param string $integerNote2
     *
     * @return ProductNote
     */
    public function setIntegerNote2($integerNote2)
    {
        $this->integerNote2 = $integerNote2;

        return $this;
    }

    /**
     * Get integerNote2
     *
     * @return string
     */
    public function getIntegerNote2()
    {
        return $this->integerNote2;
    }

    /**
     * Set integerNote3
     *
     * @param string $integerNote3
     *
     * @return ProductNote
     */
    public function setIntegerNote3($integerNote3)
    {
        $this->integerNote3 = $integerNote3;

        return $this;
    }

    /**
     * Get integerNote3
     *
     * @return string
     */
    public function getIntegerNote3()
    {
        return $this->integerNote3;
    }

    /**
     * Set integerNote4
     *
     * @param string $integerNote4
     *
     * @return ProductNote
     */
    public function setIntegerNote4($integerNote4)
    {
        $this->integerNote4 = $integerNote4;

        return $this;
    }

    /**
     * Get integerNote4
     *
     * @return string
     */
    public function getIntegerNote4()
    {
        return $this->integerNote4;
    }

    /**
     * Set integerNote5
     *
     * @param string $integerNote5
     *
     * @return ProductNote
     */
    public function setIntegerNote5($integerNote5)
    {
        $this->integerNote5 = $integerNote5;

        return $this;
    }

    /**
     * Get integerNote5
     *
     * @return string
     */
    public function getIntegerNote5()
    {
        return $this->integerNote5;
    }

    /**
     * Set integerNote6
     *
     * @param string $integerNote6
     *
     * @return ProductNote
     */
    public function setIntegerNote6($integerNote6)
    {
        $this->integerNote6 = $integerNote6;

        return $this;
    }

    /**
     * Get integerNote6
     *
     * @return string
     */
    public function getIntegerNote6()
    {
        return $this->integerNote6;
    }

    /**
     * Set integerNote7
     *
     * @param string $integerNote7
     *
     * @return ProductNote
     */
    public function setIntegerNote7($integerNote7)
    {
        $this->integerNote7 = $integerNote7;

        return $this;
    }

    /**
     * Get integerNote7
     *
     * @return string
     */
    public function getIntegerNote7()
    {
        return $this->integerNote7;
    }

    /**
     * Set integerNote8
     *
     * @param string $integerNote8
     *
     * @return ProductNote
     */
    public function setIntegerNote8($integerNote8)
    {
        $this->integerNote8 = $integerNote8;

        return $this;
    }

    /**
     * Get integerNote8
     *
     * @return string
     */
    public function getIntegerNote8()
    {
        return $this->integerNote8;
    }

    /**
     * Set integerNote9
     *
     * @param string $integerNote9
     *
     * @return ProductNote
     */
    public function setIntegerNote9($integerNote9)
    {
        $this->integerNote9 = $integerNote9;

        return $this;
    }

    /**
     * Get integerNote9
     *
     * @return string
     */
    public function getIntegerNote9()
    {
        return $this->integerNote9;
    }

    /**
     * Set integerNote10
     *
     * @param string $integerNote10
     *
     * @return ProductNote
     */
    public function setIntegerNote10($integerNote10)
    {
        $this->integerNote10 = $integerNote10;

        return $this;
    }

    /**
     * Get integerNote10
     *
     * @return string
     */
    public function getIntegerNote10()
    {
        return $this->integerNote10;
    }

    /**
     * Set integerNote11
     *
     * @param string $integerNote11
     *
     * @return ProductNote
     */
    public function setIntegerNote11($integerNote11)
    {
        $this->integerNote11 = $integerNote11;

        return $this;
    }

    /**
     * Get integerNote11
     *
     * @return string
     */
    public function getIntegerNote11()
    {
        return $this->integerNote11;
    }

    /**
     * Set integerNote12
     *
     * @param string $integerNote12
     *
     * @return ProductNote
     */
    public function setIntegerNote12($integerNote12)
    {
        $this->integerNote12 = $integerNote12;

        return $this;
    }

    /**
     * Get integerNote12
     *
     * @return string
     */
    public function getIntegerNote12()
    {
        return $this->integerNote12;
    }

    /**
     * Set integerNote13
     *
     * @param string $integerNote13
     *
     * @return ProductNote
     */
    public function setIntegerNote13($integerNote13)
    {
        $this->integerNote13 = $integerNote13;

        return $this;
    }

    /**
     * Get integerNote13
     *
     * @return string
     */
    public function getIntegerNote13()
    {
        return $this->integerNote13;
    }

    /**
     * Set integerNote14
     *
     * @param string $integerNote14
     *
     * @return ProductNote
     */
    public function setIntegerNote14($integerNote14)
    {
        $this->integerNote14 = $integerNote14;

        return $this;
    }

    /**
     * Get integerNote14
     *
     * @return string
     */
    public function getIntegerNote14()
    {
        return $this->integerNote14;
    }

    /**
     * Set integerNote15
     *
     * @param string $integerNote15
     *
     * @return ProductNote
     */
    public function setIntegerNote15($integerNote15)
    {
        $this->integerNote15 = $integerNote15;

        return $this;
    }

    /**
     * Get integerNote15
     *
     * @return string
     */
    public function getIntegerNote15()
    {
        return $this->integerNote15;
    }

    /**
     * Set integerNote16
     *
     * @param string $integerNote16
     *
     * @return ProductNote
     */
    public function setIntegerNote16($integerNote16)
    {
        $this->integerNote16 = $integerNote16;

        return $this;
    }

    /**
     * Get integerNote16
     *
     * @return string
     */
    public function getIntegerNote16()
    {
        return $this->integerNote16;
    }

    /**
     * Set integerNote17
     *
     * @param string $integerNote17
     *
     * @return ProductNote
     */
    public function setIntegerNote17($integerNote17)
    {
        $this->integerNote17 = $integerNote17;

        return $this;
    }

    /**
     * Get integerNote17
     *
     * @return string
     */
    public function getIntegerNote17()
    {
        return $this->integerNote17;
    }

    /**
     * Set integerNote18
     *
     * @param string $integerNote18
     *
     * @return ProductNote
     */
    public function setIntegerNote18($integerNote18)
    {
        $this->integerNote18 = $integerNote18;

        return $this;
    }

    /**
     * Get integerNote18
     *
     * @return string
     */
    public function getIntegerNote18()
    {
        return $this->integerNote18;
    }

    /**
     * Set integerNote19
     *
     * @param string $integerNote19
     *
     * @return ProductNote
     */
    public function setIntegerNote19($integerNote19)
    {
        $this->integerNote19 = $integerNote19;

        return $this;
    }

    /**
     * Get integerNote19
     *
     * @return string
     */
    public function getIntegerNote19()
    {
        return $this->integerNote19;
    }

    /**
     * Set integerNote20
     *
     * @param string $integerNote20
     *
     * @return ProductNote
     */
    public function setIntegerNote20($integerNote20)
    {
        $this->integerNote20 = $integerNote20;

        return $this;
    }

    /**
     * Get integerNote20
     *
     * @return string
     */
    public function getIntegerNote20()
    {
        return $this->integerNote20;
    }

    /**
     * Set integerNote21
     *
     * @param string $integerNote21
     *
     * @return ProductNote
     */
    public function setIntegerNote21($integerNote21)
    {
        $this->integerNote21 = $integerNote21;

        return $this;
    }

    /**
     * Get integerNote21
     *
     * @return string
     */
    public function getIntegerNote21()
    {
        return $this->integerNote21;
    }

    /**
     * Set integerNote22
     *
     * @param string $integerNote22
     *
     * @return ProductNote
     */
    public function setIntegerNote22($integerNote22)
    {
        $this->integerNote22 = $integerNote22;

        return $this;
    }

    /**
     * Get integerNote22
     *
     * @return string
     */
    public function getIntegerNote22()
    {
        return $this->integerNote22;
    }

    /**
     * Set integerNote23
     *
     * @param string $integerNote23
     *
     * @return ProductNote
     */
    public function setIntegerNote23($integerNote23)
    {
        $this->integerNote23 = $integerNote23;

        return $this;
    }

    /**
     * Get integerNote23
     *
     * @return string
     */
    public function getIntegerNote23()
    {
        return $this->integerNote23;
    }

    /**
     * Set integerNote24
     *
     * @param string $integerNote24
     *
     * @return ProductNote
     */
    public function setIntegerNote24($integerNote24)
    {
        $this->integerNote24 = $integerNote24;

        return $this;
    }

    /**
     * Get integerNote24
     *
     * @return string
     */
    public function getIntegerNote24()
    {
        return $this->integerNote24;
    }

    /**
     * Set integerNote25
     *
     * @param string $integerNote25
     *
     * @return ProductNote
     */
    public function setIntegerNote25($integerNote25)
    {
        $this->integerNote25 = $integerNote25;

        return $this;
    }

    /**
     * Get integerNote25
     *
     * @return string
     */
    public function getIntegerNote25()
    {
        return $this->integerNote25;
    }

    /**
     * Set integerNote26
     *
     * @param string $integerNote26
     *
     * @return ProductNote
     */
    public function setIntegerNote26($integerNote26)
    {
        $this->integerNote26 = $integerNote26;

        return $this;
    }

    /**
     * Get integerNote26
     *
     * @return string
     */
    public function getIntegerNote26()
    {
        return $this->integerNote26;
    }

    /**
     * Set integerNote27
     *
     * @param string $integerNote27
     *
     * @return ProductNote
     */
    public function setIntegerNote27($integerNote27)
    {
        $this->integerNote27 = $integerNote27;

        return $this;
    }

    /**
     * Get integerNote27
     *
     * @return string
     */
    public function getIntegerNote27()
    {
        return $this->integerNote27;
    }

    /**
     * Set integerNote28
     *
     * @param string $integerNote28
     *
     * @return ProductNote
     */
    public function setIntegerNote28($integerNote28)
    {
        $this->integerNote28 = $integerNote28;

        return $this;
    }

    /**
     * Get integerNote28
     *
     * @return string
     */
    public function getIntegerNote28()
    {
        return $this->integerNote28;
    }

    /**
     * Set integerNote29
     *
     * @param string $integerNote29
     *
     * @return ProductNote
     */
    public function setIntegerNote29($integerNote29)
    {
        $this->integerNote29 = $integerNote29;

        return $this;
    }

    /**
     * Get integerNote29
     *
     * @return string
     */
    public function getIntegerNote29()
    {
        return $this->integerNote29;
    }

    /**
     * Set integerNote30
     *
     * @param string $integerNote30
     *
     * @return ProductNote
     */
    public function setIntegerNote30($integerNote30)
    {
        $this->integerNote30 = $integerNote30;

        return $this;
    }

    /**
     * Get integerNote30
     *
     * @return string
     */
    public function getIntegerNote30()
    {
        return $this->integerNote30;
    }

    /**
     * Set stringNote1
     *
     * @param string $stringNote1
     *
     * @return ProductNote
     */
    public function setStringNote1($stringNote1)
    {
        $this->stringNote1 = $stringNote1;

        return $this;
    }

    /**
     * Get stringNote1
     *
     * @return string
     */
    public function getStringNote1()
    {
        return $this->stringNote1;
    }

    /**
     * Set stringNote2
     *
     * @param string $stringNote2
     *
     * @return ProductNote
     */
    public function setStringNote2($stringNote2)
    {
        $this->stringNote2 = $stringNote2;

        return $this;
    }

    /**
     * Get stringNote2
     *
     * @return string
     */
    public function getStringNote2()
    {
        return $this->stringNote2;
    }

    /**
     * Set stringNote3
     *
     * @param string $stringNote3
     *
     * @return ProductNote
     */
    public function setStringNote3($stringNote3)
    {
        $this->stringNote3 = $stringNote3;

        return $this;
    }

    /**
     * Get stringNote3
     *
     * @return string
     */
    public function getStringNote3()
    {
        return $this->stringNote3;
    }

    /**
     * Set stringNote4
     *
     * @param string $stringNote4
     *
     * @return ProductNote
     */
    public function setStringNote4($stringNote4)
    {
        $this->stringNote4 = $stringNote4;

        return $this;
    }

    /**
     * Get stringNote4
     *
     * @return string
     */
    public function getStringNote4()
    {
        return $this->stringNote4;
    }

    /**
     * Set stringNote5
     *
     * @param string $stringNote5
     *
     * @return ProductNote
     */
    public function setStringNote5($stringNote5)
    {
        $this->stringNote5 = $stringNote5;

        return $this;
    }

    /**
     * Get stringNote5
     *
     * @return string
     */
    public function getStringNote5()
    {
        return $this->stringNote5;
    }

    /**
     * Set stringNote6
     *
     * @param string $stringNote6
     *
     * @return ProductNote
     */
    public function setStringNote6($stringNote6)
    {
        $this->stringNote6 = $stringNote6;

        return $this;
    }

    /**
     * Get stringNote6
     *
     * @return string
     */
    public function getStringNote6()
    {
        return $this->stringNote6;
    }

    /**
     * Set stringNote7
     *
     * @param string $stringNote7
     *
     * @return ProductNote
     */
    public function setStringNote7($stringNote7)
    {
        $this->stringNote7 = $stringNote7;

        return $this;
    }

    /**
     * Get stringNote7
     *
     * @return string
     */
    public function getStringNote7()
    {
        return $this->stringNote7;
    }

    /**
     * Set stringNote8
     *
     * @param string $stringNote8
     *
     * @return ProductNote
     */
    public function setStringNote8($stringNote8)
    {
        $this->stringNote8 = $stringNote8;

        return $this;
    }

    /**
     * Get stringNote8
     *
     * @return string
     */
    public function getStringNote8()
    {
        return $this->stringNote8;
    }

    /**
     * Set stringNote9
     *
     * @param string $stringNote9
     *
     * @return ProductNote
     */
    public function setStringNote9($stringNote9)
    {
        $this->stringNote9 = $stringNote9;

        return $this;
    }

    /**
     * Get stringNote9
     *
     * @return string
     */
    public function getStringNote9()
    {
        return $this->stringNote9;
    }

    /**
     * Set stringNote10
     *
     * @param string $stringNote10
     *
     * @return ProductNote
     */
    public function setStringNote10($stringNote10)
    {
        $this->stringNote10 = $stringNote10;

        return $this;
    }

    /**
     * Get stringNote10
     *
     * @return string
     */
    public function getStringNote10()
    {
        return $this->stringNote10;
    }

    /**
     * Set stringNote11
     *
     * @param string $stringNote11
     *
     * @return ProductNote
     */
    public function setStringNote11($stringNote11)
    {
        $this->stringNote11 = $stringNote11;

        return $this;
    }

    /**
     * Get stringNote11
     *
     * @return string
     */
    public function getStringNote11()
    {
        return $this->stringNote11;
    }

    /**
     * Set stringNote12
     *
     * @param string $stringNote12
     *
     * @return ProductNote
     */
    public function setStringNote12($stringNote12)
    {
        $this->stringNote12 = $stringNote12;

        return $this;
    }

    /**
     * Get stringNote12
     *
     * @return string
     */
    public function getStringNote12()
    {
        return $this->stringNote12;
    }

    /**
     * Set stringNote13
     *
     * @param string $stringNote13
     *
     * @return ProductNote
     */
    public function setStringNote13($stringNote13)
    {
        $this->stringNote13 = $stringNote13;

        return $this;
    }

    /**
     * Get stringNote13
     *
     * @return string
     */
    public function getStringNote13()
    {
        return $this->stringNote13;
    }

    /**
     * Set stringNote14
     *
     * @param string $stringNote14
     *
     * @return ProductNote
     */
    public function setStringNote14($stringNote14)
    {
        $this->stringNote14 = $stringNote14;

        return $this;
    }

    /**
     * Get stringNote14
     *
     * @return string
     */
    public function getStringNote14()
    {
        return $this->stringNote14;
    }

    /**
     * Set stringNote15
     *
     * @param string $stringNote15
     *
     * @return ProductNote
     */
    public function setStringNote15($stringNote15)
    {
        $this->stringNote15 = $stringNote15;

        return $this;
    }

    /**
     * Get stringNote15
     *
     * @return string
     */
    public function getStringNote15()
    {
        return $this->stringNote15;
    }

    /**
     * Set stringNote16
     *
     * @param string $stringNote16
     *
     * @return ProductNote
     */
    public function setStringNote16($stringNote16)
    {
        $this->stringNote16 = $stringNote16;

        return $this;
    }

    /**
     * Get stringNote16
     *
     * @return string
     */
    public function getStringNote16()
    {
        return $this->stringNote16;
    }

    /**
     * Set stringNote17
     *
     * @param string $stringNote17
     *
     * @return ProductNote
     */
    public function setStringNote17($stringNote17)
    {
        $this->stringNote17 = $stringNote17;

        return $this;
    }

    /**
     * Get stringNote17
     *
     * @return string
     */
    public function getStringNote17()
    {
        return $this->stringNote17;
    }

    /**
     * Set stringNote18
     *
     * @param string $stringNote18
     *
     * @return ProductNote
     */
    public function setStringNote18($stringNote18)
    {
        $this->stringNote18 = $stringNote18;

        return $this;
    }

    /**
     * Get stringNote18
     *
     * @return string
     */
    public function getStringNote18()
    {
        return $this->stringNote18;
    }

    /**
     * Set stringNote19
     *
     * @param string $stringNote19
     *
     * @return ProductNote
     */
    public function setStringNote19($stringNote19)
    {
        $this->stringNote19 = $stringNote19;

        return $this;
    }

    /**
     * Get stringNote19
     *
     * @return string
     */
    public function getStringNote19()
    {
        return $this->stringNote19;
    }

    /**
     * Set stringNote20
     *
     * @param string $stringNote20
     *
     * @return ProductNote
     */
    public function setStringNote20($stringNote20)
    {
        $this->stringNote20 = $stringNote20;

        return $this;
    }

    /**
     * Get stringNote20
     *
     * @return string
     */
    public function getStringNote20()
    {
        return $this->stringNote20;
    }

    /**
     * Set stringNote21
     *
     * @param string $stringNote21
     *
     * @return ProductNote
     */
    public function setStringNote21($stringNote21)
    {
        $this->stringNote21 = $stringNote21;

        return $this;
    }

    /**
     * Get stringNote21
     *
     * @return string
     */
    public function getStringNote21()
    {
        return $this->stringNote21;
    }

    /**
     * Set stringNote22
     *
     * @param string $stringNote22
     *
     * @return ProductNote
     */
    public function setStringNote22($stringNote22)
    {
        $this->stringNote22 = $stringNote22;

        return $this;
    }

    /**
     * Get stringNote22
     *
     * @return string
     */
    public function getStringNote22()
    {
        return $this->stringNote22;
    }

    /**
     * Set stringNote23
     *
     * @param string $stringNote23
     *
     * @return ProductNote
     */
    public function setStringNote23($stringNote23)
    {
        $this->stringNote23 = $stringNote23;

        return $this;
    }

    /**
     * Get stringNote23
     *
     * @return string
     */
    public function getStringNote23()
    {
        return $this->stringNote23;
    }

    /**
     * Set stringNote24
     *
     * @param string $stringNote24
     *
     * @return ProductNote
     */
    public function setStringNote24($stringNote24)
    {
        $this->stringNote24 = $stringNote24;

        return $this;
    }

    /**
     * Get stringNote24
     *
     * @return string
     */
    public function getStringNote24()
    {
        return $this->stringNote24;
    }

    /**
     * Set stringNote25
     *
     * @param string $stringNote25
     *
     * @return ProductNote
     */
    public function setStringNote25($stringNote25)
    {
        $this->stringNote25 = $stringNote25;

        return $this;
    }

    /**
     * Get stringNote25
     *
     * @return string
     */
    public function getStringNote25()
    {
        return $this->stringNote25;
    }

    /**
     * Set stringNote26
     *
     * @param string $stringNote26
     *
     * @return ProductNote
     */
    public function setStringNote26($stringNote26)
    {
        $this->stringNote26 = $stringNote26;

        return $this;
    }

    /**
     * Get stringNote26
     *
     * @return string
     */
    public function getStringNote26()
    {
        return $this->stringNote26;
    }

    /**
     * Set stringNote27
     *
     * @param string $stringNote27
     *
     * @return ProductNote
     */
    public function setStringNote27($stringNote27)
    {
        $this->stringNote27 = $stringNote27;

        return $this;
    }

    /**
     * Get stringNote27
     *
     * @return string
     */
    public function getStringNote27()
    {
        return $this->stringNote27;
    }

    /**
     * Set stringNote28
     *
     * @param string $stringNote28
     *
     * @return ProductNote
     */
    public function setStringNote28($stringNote28)
    {
        $this->stringNote28 = $stringNote28;

        return $this;
    }

    /**
     * Get stringNote28
     *
     * @return string
     */
    public function getStringNote28()
    {
        return $this->stringNote28;
    }

    /**
     * Set stringNote29
     *
     * @param string $stringNote29
     *
     * @return ProductNote
     */
    public function setStringNote29($stringNote29)
    {
        $this->stringNote29 = $stringNote29;

        return $this;
    }

    /**
     * Get stringNote29
     *
     * @return string
     */
    public function getStringNote29()
    {
        return $this->stringNote29;
    }

    /**
     * Set stringNote30
     *
     * @param string $stringNote30
     *
     * @return ProductNote
     */
    public function setStringNote30($stringNote30)
    {
        $this->stringNote30 = $stringNote30;

        return $this;
    }

    /**
     * Get stringNote30
     *
     * @return string
     */
    public function getStringNote30()
    {
        return $this->stringNote30;
    }

    /**
     * Set productCategoryAssignment
     *
     * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return ProductNote
     */
    public function setProductCategoryAssignment(\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment = null)
    {
        $this->productCategoryAssignment = $productCategoryAssignment;

        return $this;
    }

    /**
     * Get productCategoryAssignment
     *
     * @return \AppBundle\Entity\Assignments\ProductCategoryAssignment
     */
    public function getProductCategoryAssignment()
    {
        return $this->productCategoryAssignment;
    }
}
