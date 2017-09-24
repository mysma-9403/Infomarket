<?php

namespace AppBundle\Entity\Main;

use AppBundle\Entity\Base\Image;
use AppBundle\Utils\StringUtils;

class Product extends Image implements \ArrayAccess {

	public function getDisplayName() {
		if ($this->brand) {
			return $this->brand->getName() . ' ' . $this->getName();
		}
		return $this->name;
	}

	public function getUploadPath() {
		$brandName = StringUtils::getCleanName($this->getBrand()->getName());
		return 'uploads/products/' . substr($brandName, 0, 1) . '/' . $brandName;
	}

	public function offsetExists($offset) {
		if (strpos($offset, 'decimal') !== false) {
			return true;
		}
		
		if (strpos($offset, 'integer') !== false) {
			return true;
		}
		
		if (strpos($offset, 'string') !== false) {
			return true;
		}
		
		if (strpos($offset, 'price') !== false) {
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

	public function __construct() {
		parent::__construct();
		
		$this->infomarket = false;
		$this->infoprodukt = false;
		$this->custom = false;
	}
    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $infomarket;

    /**
     * @var boolean
     */
    private $infoprodukt;

    /**
     * @var boolean
     */
    private $custom;

    /**
     * @var string
     */
    private $topProduktImage;

    /**
     * @var string
     */
    private $price;

    /**
     * @var string
     */
    private $decimal1;

    /**
     * @var string
     */
    private $decimal2;

    /**
     * @var string
     */
    private $decimal3;

    /**
     * @var string
     */
    private $decimal4;

    /**
     * @var string
     */
    private $decimal5;

    /**
     * @var string
     */
    private $decimal6;

    /**
     * @var string
     */
    private $decimal7;

    /**
     * @var string
     */
    private $decimal8;

    /**
     * @var string
     */
    private $decimal9;

    /**
     * @var string
     */
    private $decimal10;

    /**
     * @var string
     */
    private $decimal11;

    /**
     * @var string
     */
    private $decimal12;

    /**
     * @var string
     */
    private $decimal13;

    /**
     * @var string
     */
    private $decimal14;

    /**
     * @var string
     */
    private $decimal15;

    /**
     * @var string
     */
    private $decimal16;

    /**
     * @var string
     */
    private $decimal17;

    /**
     * @var string
     */
    private $decimal18;

    /**
     * @var string
     */
    private $decimal19;

    /**
     * @var string
     */
    private $decimal20;

    /**
     * @var string
     */
    private $decimal21;

    /**
     * @var string
     */
    private $decimal22;

    /**
     * @var string
     */
    private $decimal23;

    /**
     * @var string
     */
    private $decimal24;

    /**
     * @var string
     */
    private $decimal25;

    /**
     * @var string
     */
    private $decimal26;

    /**
     * @var string
     */
    private $decimal27;

    /**
     * @var string
     */
    private $decimal28;

    /**
     * @var string
     */
    private $decimal29;

    /**
     * @var string
     */
    private $decimal30;

    /**
     * @var integer
     */
    private $integer1;

    /**
     * @var integer
     */
    private $integer2;

    /**
     * @var integer
     */
    private $integer3;

    /**
     * @var integer
     */
    private $integer4;

    /**
     * @var integer
     */
    private $integer5;

    /**
     * @var integer
     */
    private $integer6;

    /**
     * @var integer
     */
    private $integer7;

    /**
     * @var integer
     */
    private $integer8;

    /**
     * @var integer
     */
    private $integer9;

    /**
     * @var integer
     */
    private $integer10;

    /**
     * @var integer
     */
    private $integer11;

    /**
     * @var integer
     */
    private $integer12;

    /**
     * @var integer
     */
    private $integer13;

    /**
     * @var integer
     */
    private $integer14;

    /**
     * @var integer
     */
    private $integer15;

    /**
     * @var integer
     */
    private $integer16;

    /**
     * @var integer
     */
    private $integer17;

    /**
     * @var integer
     */
    private $integer18;

    /**
     * @var integer
     */
    private $integer19;

    /**
     * @var integer
     */
    private $integer20;

    /**
     * @var integer
     */
    private $integer21;

    /**
     * @var integer
     */
    private $integer22;

    /**
     * @var integer
     */
    private $integer23;

    /**
     * @var integer
     */
    private $integer24;

    /**
     * @var integer
     */
    private $integer25;

    /**
     * @var integer
     */
    private $integer26;

    /**
     * @var integer
     */
    private $integer27;

    /**
     * @var integer
     */
    private $integer28;

    /**
     * @var integer
     */
    private $integer29;

    /**
     * @var integer
     */
    private $integer30;

    /**
     * @var string
     */
    private $string1;

    /**
     * @var string
     */
    private $string2;

    /**
     * @var string
     */
    private $string3;

    /**
     * @var string
     */
    private $string4;

    /**
     * @var string
     */
    private $string5;

    /**
     * @var string
     */
    private $string6;

    /**
     * @var string
     */
    private $string7;

    /**
     * @var string
     */
    private $string8;

    /**
     * @var string
     */
    private $string9;

    /**
     * @var string
     */
    private $string10;

    /**
     * @var string
     */
    private $string11;

    /**
     * @var string
     */
    private $string12;

    /**
     * @var string
     */
    private $string13;

    /**
     * @var string
     */
    private $string14;

    /**
     * @var string
     */
    private $string15;

    /**
     * @var string
     */
    private $string16;

    /**
     * @var string
     */
    private $string17;

    /**
     * @var string
     */
    private $string18;

    /**
     * @var string
     */
    private $string19;

    /**
     * @var string
     */
    private $string20;

    /**
     * @var string
     */
    private $string21;

    /**
     * @var string
     */
    private $string22;

    /**
     * @var string
     */
    private $string23;

    /**
     * @var string
     */
    private $string24;

    /**
     * @var string
     */
    private $string25;

    /**
     * @var string
     */
    private $string26;

    /**
     * @var string
     */
    private $string27;

    /**
     * @var string
     */
    private $string28;

    /**
     * @var string
     */
    private $string29;

    /**
     * @var string
     */
    private $string30;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \AppBundle\Entity\Main\Brand
     */
    private $brand;

    /**
     * @var \AppBundle\Entity\Main\BenchmarkQuery
     */
    private $benchmarkQuery;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set infomarket
     *
     * @param boolean $infomarket
     *
     * @return Product
     */
    public function setInfomarket($infomarket)
    {
        $this->infomarket = $infomarket;

        return $this;
    }

    /**
     * Get infomarket
     *
     * @return boolean
     */
    public function getInfomarket()
    {
        return $this->infomarket;
    }

    /**
     * Set infoprodukt
     *
     * @param boolean $infoprodukt
     *
     * @return Product
     */
    public function setInfoprodukt($infoprodukt)
    {
        $this->infoprodukt = $infoprodukt;

        return $this;
    }

    /**
     * Get infoprodukt
     *
     * @return boolean
     */
    public function getInfoprodukt()
    {
        return $this->infoprodukt;
    }

    /**
     * Set custom
     *
     * @param boolean $custom
     *
     * @return Product
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;

        return $this;
    }

    /**
     * Get custom
     *
     * @return boolean
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * Set topProduktImage
     *
     * @param string $topProduktImage
     *
     * @return Product
     */
    public function setTopProduktImage($topProduktImage)
    {
        $this->topProduktImage = $topProduktImage;

        return $this;
    }

    /**
     * Get topProduktImage
     *
     * @return string
     */
    public function getTopProduktImage()
    {
        return $this->topProduktImage;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set decimal1
     *
     * @param string $decimal1
     *
     * @return Product
     */
    public function setDecimal1($decimal1)
    {
        $this->decimal1 = $decimal1;

        return $this;
    }

    /**
     * Get decimal1
     *
     * @return string
     */
    public function getDecimal1()
    {
        return $this->decimal1;
    }

    /**
     * Set decimal2
     *
     * @param string $decimal2
     *
     * @return Product
     */
    public function setDecimal2($decimal2)
    {
        $this->decimal2 = $decimal2;

        return $this;
    }

    /**
     * Get decimal2
     *
     * @return string
     */
    public function getDecimal2()
    {
        return $this->decimal2;
    }

    /**
     * Set decimal3
     *
     * @param string $decimal3
     *
     * @return Product
     */
    public function setDecimal3($decimal3)
    {
        $this->decimal3 = $decimal3;

        return $this;
    }

    /**
     * Get decimal3
     *
     * @return string
     */
    public function getDecimal3()
    {
        return $this->decimal3;
    }

    /**
     * Set decimal4
     *
     * @param string $decimal4
     *
     * @return Product
     */
    public function setDecimal4($decimal4)
    {
        $this->decimal4 = $decimal4;

        return $this;
    }

    /**
     * Get decimal4
     *
     * @return string
     */
    public function getDecimal4()
    {
        return $this->decimal4;
    }

    /**
     * Set decimal5
     *
     * @param string $decimal5
     *
     * @return Product
     */
    public function setDecimal5($decimal5)
    {
        $this->decimal5 = $decimal5;

        return $this;
    }

    /**
     * Get decimal5
     *
     * @return string
     */
    public function getDecimal5()
    {
        return $this->decimal5;
    }

    /**
     * Set decimal6
     *
     * @param string $decimal6
     *
     * @return Product
     */
    public function setDecimal6($decimal6)
    {
        $this->decimal6 = $decimal6;

        return $this;
    }

    /**
     * Get decimal6
     *
     * @return string
     */
    public function getDecimal6()
    {
        return $this->decimal6;
    }

    /**
     * Set decimal7
     *
     * @param string $decimal7
     *
     * @return Product
     */
    public function setDecimal7($decimal7)
    {
        $this->decimal7 = $decimal7;

        return $this;
    }

    /**
     * Get decimal7
     *
     * @return string
     */
    public function getDecimal7()
    {
        return $this->decimal7;
    }

    /**
     * Set decimal8
     *
     * @param string $decimal8
     *
     * @return Product
     */
    public function setDecimal8($decimal8)
    {
        $this->decimal8 = $decimal8;

        return $this;
    }

    /**
     * Get decimal8
     *
     * @return string
     */
    public function getDecimal8()
    {
        return $this->decimal8;
    }

    /**
     * Set decimal9
     *
     * @param string $decimal9
     *
     * @return Product
     */
    public function setDecimal9($decimal9)
    {
        $this->decimal9 = $decimal9;

        return $this;
    }

    /**
     * Get decimal9
     *
     * @return string
     */
    public function getDecimal9()
    {
        return $this->decimal9;
    }

    /**
     * Set decimal10
     *
     * @param string $decimal10
     *
     * @return Product
     */
    public function setDecimal10($decimal10)
    {
        $this->decimal10 = $decimal10;

        return $this;
    }

    /**
     * Get decimal10
     *
     * @return string
     */
    public function getDecimal10()
    {
        return $this->decimal10;
    }

    /**
     * Set decimal11
     *
     * @param string $decimal11
     *
     * @return Product
     */
    public function setDecimal11($decimal11)
    {
        $this->decimal11 = $decimal11;

        return $this;
    }

    /**
     * Get decimal11
     *
     * @return string
     */
    public function getDecimal11()
    {
        return $this->decimal11;
    }

    /**
     * Set decimal12
     *
     * @param string $decimal12
     *
     * @return Product
     */
    public function setDecimal12($decimal12)
    {
        $this->decimal12 = $decimal12;

        return $this;
    }

    /**
     * Get decimal12
     *
     * @return string
     */
    public function getDecimal12()
    {
        return $this->decimal12;
    }

    /**
     * Set decimal13
     *
     * @param string $decimal13
     *
     * @return Product
     */
    public function setDecimal13($decimal13)
    {
        $this->decimal13 = $decimal13;

        return $this;
    }

    /**
     * Get decimal13
     *
     * @return string
     */
    public function getDecimal13()
    {
        return $this->decimal13;
    }

    /**
     * Set decimal14
     *
     * @param string $decimal14
     *
     * @return Product
     */
    public function setDecimal14($decimal14)
    {
        $this->decimal14 = $decimal14;

        return $this;
    }

    /**
     * Get decimal14
     *
     * @return string
     */
    public function getDecimal14()
    {
        return $this->decimal14;
    }

    /**
     * Set decimal15
     *
     * @param string $decimal15
     *
     * @return Product
     */
    public function setDecimal15($decimal15)
    {
        $this->decimal15 = $decimal15;

        return $this;
    }

    /**
     * Get decimal15
     *
     * @return string
     */
    public function getDecimal15()
    {
        return $this->decimal15;
    }

    /**
     * Set decimal16
     *
     * @param string $decimal16
     *
     * @return Product
     */
    public function setDecimal16($decimal16)
    {
        $this->decimal16 = $decimal16;

        return $this;
    }

    /**
     * Get decimal16
     *
     * @return string
     */
    public function getDecimal16()
    {
        return $this->decimal16;
    }

    /**
     * Set decimal17
     *
     * @param string $decimal17
     *
     * @return Product
     */
    public function setDecimal17($decimal17)
    {
        $this->decimal17 = $decimal17;

        return $this;
    }

    /**
     * Get decimal17
     *
     * @return string
     */
    public function getDecimal17()
    {
        return $this->decimal17;
    }

    /**
     * Set decimal18
     *
     * @param string $decimal18
     *
     * @return Product
     */
    public function setDecimal18($decimal18)
    {
        $this->decimal18 = $decimal18;

        return $this;
    }

    /**
     * Get decimal18
     *
     * @return string
     */
    public function getDecimal18()
    {
        return $this->decimal18;
    }

    /**
     * Set decimal19
     *
     * @param string $decimal19
     *
     * @return Product
     */
    public function setDecimal19($decimal19)
    {
        $this->decimal19 = $decimal19;

        return $this;
    }

    /**
     * Get decimal19
     *
     * @return string
     */
    public function getDecimal19()
    {
        return $this->decimal19;
    }

    /**
     * Set decimal20
     *
     * @param string $decimal20
     *
     * @return Product
     */
    public function setDecimal20($decimal20)
    {
        $this->decimal20 = $decimal20;

        return $this;
    }

    /**
     * Get decimal20
     *
     * @return string
     */
    public function getDecimal20()
    {
        return $this->decimal20;
    }

    /**
     * Set decimal21
     *
     * @param string $decimal21
     *
     * @return Product
     */
    public function setDecimal21($decimal21)
    {
        $this->decimal21 = $decimal21;

        return $this;
    }

    /**
     * Get decimal21
     *
     * @return string
     */
    public function getDecimal21()
    {
        return $this->decimal21;
    }

    /**
     * Set decimal22
     *
     * @param string $decimal22
     *
     * @return Product
     */
    public function setDecimal22($decimal22)
    {
        $this->decimal22 = $decimal22;

        return $this;
    }

    /**
     * Get decimal22
     *
     * @return string
     */
    public function getDecimal22()
    {
        return $this->decimal22;
    }

    /**
     * Set decimal23
     *
     * @param string $decimal23
     *
     * @return Product
     */
    public function setDecimal23($decimal23)
    {
        $this->decimal23 = $decimal23;

        return $this;
    }

    /**
     * Get decimal23
     *
     * @return string
     */
    public function getDecimal23()
    {
        return $this->decimal23;
    }

    /**
     * Set decimal24
     *
     * @param string $decimal24
     *
     * @return Product
     */
    public function setDecimal24($decimal24)
    {
        $this->decimal24 = $decimal24;

        return $this;
    }

    /**
     * Get decimal24
     *
     * @return string
     */
    public function getDecimal24()
    {
        return $this->decimal24;
    }

    /**
     * Set decimal25
     *
     * @param string $decimal25
     *
     * @return Product
     */
    public function setDecimal25($decimal25)
    {
        $this->decimal25 = $decimal25;

        return $this;
    }

    /**
     * Get decimal25
     *
     * @return string
     */
    public function getDecimal25()
    {
        return $this->decimal25;
    }

    /**
     * Set decimal26
     *
     * @param string $decimal26
     *
     * @return Product
     */
    public function setDecimal26($decimal26)
    {
        $this->decimal26 = $decimal26;

        return $this;
    }

    /**
     * Get decimal26
     *
     * @return string
     */
    public function getDecimal26()
    {
        return $this->decimal26;
    }

    /**
     * Set decimal27
     *
     * @param string $decimal27
     *
     * @return Product
     */
    public function setDecimal27($decimal27)
    {
        $this->decimal27 = $decimal27;

        return $this;
    }

    /**
     * Get decimal27
     *
     * @return string
     */
    public function getDecimal27()
    {
        return $this->decimal27;
    }

    /**
     * Set decimal28
     *
     * @param string $decimal28
     *
     * @return Product
     */
    public function setDecimal28($decimal28)
    {
        $this->decimal28 = $decimal28;

        return $this;
    }

    /**
     * Get decimal28
     *
     * @return string
     */
    public function getDecimal28()
    {
        return $this->decimal28;
    }

    /**
     * Set decimal29
     *
     * @param string $decimal29
     *
     * @return Product
     */
    public function setDecimal29($decimal29)
    {
        $this->decimal29 = $decimal29;

        return $this;
    }

    /**
     * Get decimal29
     *
     * @return string
     */
    public function getDecimal29()
    {
        return $this->decimal29;
    }

    /**
     * Set decimal30
     *
     * @param string $decimal30
     *
     * @return Product
     */
    public function setDecimal30($decimal30)
    {
        $this->decimal30 = $decimal30;

        return $this;
    }

    /**
     * Get decimal30
     *
     * @return string
     */
    public function getDecimal30()
    {
        return $this->decimal30;
    }

    /**
     * Set integer1
     *
     * @param integer $integer1
     *
     * @return Product
     */
    public function setInteger1($integer1)
    {
        $this->integer1 = $integer1;

        return $this;
    }

    /**
     * Get integer1
     *
     * @return integer
     */
    public function getInteger1()
    {
        return $this->integer1;
    }

    /**
     * Set integer2
     *
     * @param integer $integer2
     *
     * @return Product
     */
    public function setInteger2($integer2)
    {
        $this->integer2 = $integer2;

        return $this;
    }

    /**
     * Get integer2
     *
     * @return integer
     */
    public function getInteger2()
    {
        return $this->integer2;
    }

    /**
     * Set integer3
     *
     * @param integer $integer3
     *
     * @return Product
     */
    public function setInteger3($integer3)
    {
        $this->integer3 = $integer3;

        return $this;
    }

    /**
     * Get integer3
     *
     * @return integer
     */
    public function getInteger3()
    {
        return $this->integer3;
    }

    /**
     * Set integer4
     *
     * @param integer $integer4
     *
     * @return Product
     */
    public function setInteger4($integer4)
    {
        $this->integer4 = $integer4;

        return $this;
    }

    /**
     * Get integer4
     *
     * @return integer
     */
    public function getInteger4()
    {
        return $this->integer4;
    }

    /**
     * Set integer5
     *
     * @param integer $integer5
     *
     * @return Product
     */
    public function setInteger5($integer5)
    {
        $this->integer5 = $integer5;

        return $this;
    }

    /**
     * Get integer5
     *
     * @return integer
     */
    public function getInteger5()
    {
        return $this->integer5;
    }

    /**
     * Set integer6
     *
     * @param integer $integer6
     *
     * @return Product
     */
    public function setInteger6($integer6)
    {
        $this->integer6 = $integer6;

        return $this;
    }

    /**
     * Get integer6
     *
     * @return integer
     */
    public function getInteger6()
    {
        return $this->integer6;
    }

    /**
     * Set integer7
     *
     * @param integer $integer7
     *
     * @return Product
     */
    public function setInteger7($integer7)
    {
        $this->integer7 = $integer7;

        return $this;
    }

    /**
     * Get integer7
     *
     * @return integer
     */
    public function getInteger7()
    {
        return $this->integer7;
    }

    /**
     * Set integer8
     *
     * @param integer $integer8
     *
     * @return Product
     */
    public function setInteger8($integer8)
    {
        $this->integer8 = $integer8;

        return $this;
    }

    /**
     * Get integer8
     *
     * @return integer
     */
    public function getInteger8()
    {
        return $this->integer8;
    }

    /**
     * Set integer9
     *
     * @param integer $integer9
     *
     * @return Product
     */
    public function setInteger9($integer9)
    {
        $this->integer9 = $integer9;

        return $this;
    }

    /**
     * Get integer9
     *
     * @return integer
     */
    public function getInteger9()
    {
        return $this->integer9;
    }

    /**
     * Set integer10
     *
     * @param integer $integer10
     *
     * @return Product
     */
    public function setInteger10($integer10)
    {
        $this->integer10 = $integer10;

        return $this;
    }

    /**
     * Get integer10
     *
     * @return integer
     */
    public function getInteger10()
    {
        return $this->integer10;
    }

    /**
     * Set integer11
     *
     * @param integer $integer11
     *
     * @return Product
     */
    public function setInteger11($integer11)
    {
        $this->integer11 = $integer11;

        return $this;
    }

    /**
     * Get integer11
     *
     * @return integer
     */
    public function getInteger11()
    {
        return $this->integer11;
    }

    /**
     * Set integer12
     *
     * @param integer $integer12
     *
     * @return Product
     */
    public function setInteger12($integer12)
    {
        $this->integer12 = $integer12;

        return $this;
    }

    /**
     * Get integer12
     *
     * @return integer
     */
    public function getInteger12()
    {
        return $this->integer12;
    }

    /**
     * Set integer13
     *
     * @param integer $integer13
     *
     * @return Product
     */
    public function setInteger13($integer13)
    {
        $this->integer13 = $integer13;

        return $this;
    }

    /**
     * Get integer13
     *
     * @return integer
     */
    public function getInteger13()
    {
        return $this->integer13;
    }

    /**
     * Set integer14
     *
     * @param integer $integer14
     *
     * @return Product
     */
    public function setInteger14($integer14)
    {
        $this->integer14 = $integer14;

        return $this;
    }

    /**
     * Get integer14
     *
     * @return integer
     */
    public function getInteger14()
    {
        return $this->integer14;
    }

    /**
     * Set integer15
     *
     * @param integer $integer15
     *
     * @return Product
     */
    public function setInteger15($integer15)
    {
        $this->integer15 = $integer15;

        return $this;
    }

    /**
     * Get integer15
     *
     * @return integer
     */
    public function getInteger15()
    {
        return $this->integer15;
    }

    /**
     * Set integer16
     *
     * @param integer $integer16
     *
     * @return Product
     */
    public function setInteger16($integer16)
    {
        $this->integer16 = $integer16;

        return $this;
    }

    /**
     * Get integer16
     *
     * @return integer
     */
    public function getInteger16()
    {
        return $this->integer16;
    }

    /**
     * Set integer17
     *
     * @param integer $integer17
     *
     * @return Product
     */
    public function setInteger17($integer17)
    {
        $this->integer17 = $integer17;

        return $this;
    }

    /**
     * Get integer17
     *
     * @return integer
     */
    public function getInteger17()
    {
        return $this->integer17;
    }

    /**
     * Set integer18
     *
     * @param integer $integer18
     *
     * @return Product
     */
    public function setInteger18($integer18)
    {
        $this->integer18 = $integer18;

        return $this;
    }

    /**
     * Get integer18
     *
     * @return integer
     */
    public function getInteger18()
    {
        return $this->integer18;
    }

    /**
     * Set integer19
     *
     * @param integer $integer19
     *
     * @return Product
     */
    public function setInteger19($integer19)
    {
        $this->integer19 = $integer19;

        return $this;
    }

    /**
     * Get integer19
     *
     * @return integer
     */
    public function getInteger19()
    {
        return $this->integer19;
    }

    /**
     * Set integer20
     *
     * @param integer $integer20
     *
     * @return Product
     */
    public function setInteger20($integer20)
    {
        $this->integer20 = $integer20;

        return $this;
    }

    /**
     * Get integer20
     *
     * @return integer
     */
    public function getInteger20()
    {
        return $this->integer20;
    }

    /**
     * Set integer21
     *
     * @param integer $integer21
     *
     * @return Product
     */
    public function setInteger21($integer21)
    {
        $this->integer21 = $integer21;

        return $this;
    }

    /**
     * Get integer21
     *
     * @return integer
     */
    public function getInteger21()
    {
        return $this->integer21;
    }

    /**
     * Set integer22
     *
     * @param integer $integer22
     *
     * @return Product
     */
    public function setInteger22($integer22)
    {
        $this->integer22 = $integer22;

        return $this;
    }

    /**
     * Get integer22
     *
     * @return integer
     */
    public function getInteger22()
    {
        return $this->integer22;
    }

    /**
     * Set integer23
     *
     * @param integer $integer23
     *
     * @return Product
     */
    public function setInteger23($integer23)
    {
        $this->integer23 = $integer23;

        return $this;
    }

    /**
     * Get integer23
     *
     * @return integer
     */
    public function getInteger23()
    {
        return $this->integer23;
    }

    /**
     * Set integer24
     *
     * @param integer $integer24
     *
     * @return Product
     */
    public function setInteger24($integer24)
    {
        $this->integer24 = $integer24;

        return $this;
    }

    /**
     * Get integer24
     *
     * @return integer
     */
    public function getInteger24()
    {
        return $this->integer24;
    }

    /**
     * Set integer25
     *
     * @param integer $integer25
     *
     * @return Product
     */
    public function setInteger25($integer25)
    {
        $this->integer25 = $integer25;

        return $this;
    }

    /**
     * Get integer25
     *
     * @return integer
     */
    public function getInteger25()
    {
        return $this->integer25;
    }

    /**
     * Set integer26
     *
     * @param integer $integer26
     *
     * @return Product
     */
    public function setInteger26($integer26)
    {
        $this->integer26 = $integer26;

        return $this;
    }

    /**
     * Get integer26
     *
     * @return integer
     */
    public function getInteger26()
    {
        return $this->integer26;
    }

    /**
     * Set integer27
     *
     * @param integer $integer27
     *
     * @return Product
     */
    public function setInteger27($integer27)
    {
        $this->integer27 = $integer27;

        return $this;
    }

    /**
     * Get integer27
     *
     * @return integer
     */
    public function getInteger27()
    {
        return $this->integer27;
    }

    /**
     * Set integer28
     *
     * @param integer $integer28
     *
     * @return Product
     */
    public function setInteger28($integer28)
    {
        $this->integer28 = $integer28;

        return $this;
    }

    /**
     * Get integer28
     *
     * @return integer
     */
    public function getInteger28()
    {
        return $this->integer28;
    }

    /**
     * Set integer29
     *
     * @param integer $integer29
     *
     * @return Product
     */
    public function setInteger29($integer29)
    {
        $this->integer29 = $integer29;

        return $this;
    }

    /**
     * Get integer29
     *
     * @return integer
     */
    public function getInteger29()
    {
        return $this->integer29;
    }

    /**
     * Set integer30
     *
     * @param integer $integer30
     *
     * @return Product
     */
    public function setInteger30($integer30)
    {
        $this->integer30 = $integer30;

        return $this;
    }

    /**
     * Get integer30
     *
     * @return integer
     */
    public function getInteger30()
    {
        return $this->integer30;
    }

    /**
     * Set string1
     *
     * @param string $string1
     *
     * @return Product
     */
    public function setString1($string1)
    {
        $this->string1 = $string1;

        return $this;
    }

    /**
     * Get string1
     *
     * @return string
     */
    public function getString1()
    {
        return $this->string1;
    }

    /**
     * Set string2
     *
     * @param string $string2
     *
     * @return Product
     */
    public function setString2($string2)
    {
        $this->string2 = $string2;

        return $this;
    }

    /**
     * Get string2
     *
     * @return string
     */
    public function getString2()
    {
        return $this->string2;
    }

    /**
     * Set string3
     *
     * @param string $string3
     *
     * @return Product
     */
    public function setString3($string3)
    {
        $this->string3 = $string3;

        return $this;
    }

    /**
     * Get string3
     *
     * @return string
     */
    public function getString3()
    {
        return $this->string3;
    }

    /**
     * Set string4
     *
     * @param string $string4
     *
     * @return Product
     */
    public function setString4($string4)
    {
        $this->string4 = $string4;

        return $this;
    }

    /**
     * Get string4
     *
     * @return string
     */
    public function getString4()
    {
        return $this->string4;
    }

    /**
     * Set string5
     *
     * @param string $string5
     *
     * @return Product
     */
    public function setString5($string5)
    {
        $this->string5 = $string5;

        return $this;
    }

    /**
     * Get string5
     *
     * @return string
     */
    public function getString5()
    {
        return $this->string5;
    }

    /**
     * Set string6
     *
     * @param string $string6
     *
     * @return Product
     */
    public function setString6($string6)
    {
        $this->string6 = $string6;

        return $this;
    }

    /**
     * Get string6
     *
     * @return string
     */
    public function getString6()
    {
        return $this->string6;
    }

    /**
     * Set string7
     *
     * @param string $string7
     *
     * @return Product
     */
    public function setString7($string7)
    {
        $this->string7 = $string7;

        return $this;
    }

    /**
     * Get string7
     *
     * @return string
     */
    public function getString7()
    {
        return $this->string7;
    }

    /**
     * Set string8
     *
     * @param string $string8
     *
     * @return Product
     */
    public function setString8($string8)
    {
        $this->string8 = $string8;

        return $this;
    }

    /**
     * Get string8
     *
     * @return string
     */
    public function getString8()
    {
        return $this->string8;
    }

    /**
     * Set string9
     *
     * @param string $string9
     *
     * @return Product
     */
    public function setString9($string9)
    {
        $this->string9 = $string9;

        return $this;
    }

    /**
     * Get string9
     *
     * @return string
     */
    public function getString9()
    {
        return $this->string9;
    }

    /**
     * Set string10
     *
     * @param string $string10
     *
     * @return Product
     */
    public function setString10($string10)
    {
        $this->string10 = $string10;

        return $this;
    }

    /**
     * Get string10
     *
     * @return string
     */
    public function getString10()
    {
        return $this->string10;
    }

    /**
     * Set string11
     *
     * @param string $string11
     *
     * @return Product
     */
    public function setString11($string11)
    {
        $this->string11 = $string11;

        return $this;
    }

    /**
     * Get string11
     *
     * @return string
     */
    public function getString11()
    {
        return $this->string11;
    }

    /**
     * Set string12
     *
     * @param string $string12
     *
     * @return Product
     */
    public function setString12($string12)
    {
        $this->string12 = $string12;

        return $this;
    }

    /**
     * Get string12
     *
     * @return string
     */
    public function getString12()
    {
        return $this->string12;
    }

    /**
     * Set string13
     *
     * @param string $string13
     *
     * @return Product
     */
    public function setString13($string13)
    {
        $this->string13 = $string13;

        return $this;
    }

    /**
     * Get string13
     *
     * @return string
     */
    public function getString13()
    {
        return $this->string13;
    }

    /**
     * Set string14
     *
     * @param string $string14
     *
     * @return Product
     */
    public function setString14($string14)
    {
        $this->string14 = $string14;

        return $this;
    }

    /**
     * Get string14
     *
     * @return string
     */
    public function getString14()
    {
        return $this->string14;
    }

    /**
     * Set string15
     *
     * @param string $string15
     *
     * @return Product
     */
    public function setString15($string15)
    {
        $this->string15 = $string15;

        return $this;
    }

    /**
     * Get string15
     *
     * @return string
     */
    public function getString15()
    {
        return $this->string15;
    }

    /**
     * Set string16
     *
     * @param string $string16
     *
     * @return Product
     */
    public function setString16($string16)
    {
        $this->string16 = $string16;

        return $this;
    }

    /**
     * Get string16
     *
     * @return string
     */
    public function getString16()
    {
        return $this->string16;
    }

    /**
     * Set string17
     *
     * @param string $string17
     *
     * @return Product
     */
    public function setString17($string17)
    {
        $this->string17 = $string17;

        return $this;
    }

    /**
     * Get string17
     *
     * @return string
     */
    public function getString17()
    {
        return $this->string17;
    }

    /**
     * Set string18
     *
     * @param string $string18
     *
     * @return Product
     */
    public function setString18($string18)
    {
        $this->string18 = $string18;

        return $this;
    }

    /**
     * Get string18
     *
     * @return string
     */
    public function getString18()
    {
        return $this->string18;
    }

    /**
     * Set string19
     *
     * @param string $string19
     *
     * @return Product
     */
    public function setString19($string19)
    {
        $this->string19 = $string19;

        return $this;
    }

    /**
     * Get string19
     *
     * @return string
     */
    public function getString19()
    {
        return $this->string19;
    }

    /**
     * Set string20
     *
     * @param string $string20
     *
     * @return Product
     */
    public function setString20($string20)
    {
        $this->string20 = $string20;

        return $this;
    }

    /**
     * Get string20
     *
     * @return string
     */
    public function getString20()
    {
        return $this->string20;
    }

    /**
     * Set string21
     *
     * @param string $string21
     *
     * @return Product
     */
    public function setString21($string21)
    {
        $this->string21 = $string21;

        return $this;
    }

    /**
     * Get string21
     *
     * @return string
     */
    public function getString21()
    {
        return $this->string21;
    }

    /**
     * Set string22
     *
     * @param string $string22
     *
     * @return Product
     */
    public function setString22($string22)
    {
        $this->string22 = $string22;

        return $this;
    }

    /**
     * Get string22
     *
     * @return string
     */
    public function getString22()
    {
        return $this->string22;
    }

    /**
     * Set string23
     *
     * @param string $string23
     *
     * @return Product
     */
    public function setString23($string23)
    {
        $this->string23 = $string23;

        return $this;
    }

    /**
     * Get string23
     *
     * @return string
     */
    public function getString23()
    {
        return $this->string23;
    }

    /**
     * Set string24
     *
     * @param string $string24
     *
     * @return Product
     */
    public function setString24($string24)
    {
        $this->string24 = $string24;

        return $this;
    }

    /**
     * Get string24
     *
     * @return string
     */
    public function getString24()
    {
        return $this->string24;
    }

    /**
     * Set string25
     *
     * @param string $string25
     *
     * @return Product
     */
    public function setString25($string25)
    {
        $this->string25 = $string25;

        return $this;
    }

    /**
     * Get string25
     *
     * @return string
     */
    public function getString25()
    {
        return $this->string25;
    }

    /**
     * Set string26
     *
     * @param string $string26
     *
     * @return Product
     */
    public function setString26($string26)
    {
        $this->string26 = $string26;

        return $this;
    }

    /**
     * Get string26
     *
     * @return string
     */
    public function getString26()
    {
        return $this->string26;
    }

    /**
     * Set string27
     *
     * @param string $string27
     *
     * @return Product
     */
    public function setString27($string27)
    {
        $this->string27 = $string27;

        return $this;
    }

    /**
     * Get string27
     *
     * @return string
     */
    public function getString27()
    {
        return $this->string27;
    }

    /**
     * Set string28
     *
     * @param string $string28
     *
     * @return Product
     */
    public function setString28($string28)
    {
        $this->string28 = $string28;

        return $this;
    }

    /**
     * Get string28
     *
     * @return string
     */
    public function getString28()
    {
        return $this->string28;
    }

    /**
     * Set string29
     *
     * @param string $string29
     *
     * @return Product
     */
    public function setString29($string29)
    {
        $this->string29 = $string29;

        return $this;
    }

    /**
     * Get string29
     *
     * @return string
     */
    public function getString29()
    {
        return $this->string29;
    }

    /**
     * Set string30
     *
     * @param string $string30
     *
     * @return Product
     */
    public function setString30($string30)
    {
        $this->string30 = $string30;

        return $this;
    }

    /**
     * Get string30
     *
     * @return string
     */
    public function getString30()
    {
        return $this->string30;
    }

    /**
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Product
     */
    public function addProductCategoryAssignment(\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment)
    {
        $this->productCategoryAssignments[] = $productCategoryAssignment;

        return $this;
    }

    /**
     * Remove productCategoryAssignment
     *
     * @param \AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment
     */
    public function removeProductCategoryAssignment(\AppBundle\Entity\Assignments\ProductCategoryAssignment $productCategoryAssignment)
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
     * Set brand
     *
     * @param \AppBundle\Entity\Main\Brand $brand
     *
     * @return Product
     */
    public function setBrand(\AppBundle\Entity\Main\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Main\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set benchmarkQuery
     *
     * @param \AppBundle\Entity\Main\BenchmarkQuery $benchmarkQuery
     *
     * @return Product
     */
    public function setBenchmarkQuery(\AppBundle\Entity\Main\BenchmarkQuery $benchmarkQuery = null)
    {
        $this->benchmarkQuery = $benchmarkQuery;

        return $this;
    }

    /**
     * Get benchmarkQuery
     *
     * @return \AppBundle\Entity\Main\BenchmarkQuery
     */
    public function getBenchmarkQuery()
    {
        return $this->benchmarkQuery;
    }
}
