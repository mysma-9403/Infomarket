<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Image;
use AppBundle\Entity\Base\ImageEntity;
use AppBundle\Utils\ClassUtils;
use Intervention\Image\Exception\NotSupportedException;

/**
 * Product
 */
class Product extends ImageEntity implements \ArrayAccess
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Image::getDisplayName()
	 */
	public function getDisplayName() {
		if($this->brand) {
			return $this->brand->getName() . ' ' . $this->getName();
		}
		return $this->name;
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function getUploadPath()
	{
		$brandName = ClassUtils::getCleanName($this->getBrand()->getName());
		return 'uploads/products/' . substr($brandName, 0, 1) . '/' . $brandName;
	}

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productCategoryAssignments;

    /**
     * @var \AppBundle\Entity\Brand
     */
    private $brand;

    /**
     * Constructor
     */
    public function __construct() {
    	parent::__construct();
        $this->productCategoryAssignments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function offsetExists($offset) {
    	if(strpos($offset, 'decimal') !== false) {
    		return true;
    	}
    	
    	if(strpos($offset, 'integer') !== false) {
    		return true;
    	}
    	
    	if(strpos($offset, 'string') !== false) {
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
     * Add productCategoryAssignment
     *
     * @param \AppBundle\Entity\ProductCategoryAssignment $productCategoryAssignment
     *
     * @return Product
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
     * Set brand
     *
     * @param \AppBundle\Entity\Brand $brand
     *
     * @return Product
     */
    public function setBrand(\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \AppBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
    
    /**
     * @var string
     */
    private $topProduktImage;


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
    private $decimal_1;
    
    
    /**
     * Set decimal1
     *
     * @param string $decimal1
     *
     * @return Product
     */
    public function setDecimal1($decimal1)
    {
    	$this->decimal_1 = $decimal1;
    
    	return $this;
    }
    
    /**
     * Get decimal1
     *
     * @return string
     */
    public function getDecimal1()
    {
    	return $this->decimal_1;
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
}
