<?php

namespace AppBundle\Entity\Base;



class Simple extends Audit {
	
    /**
     * @var boolean
     */
    protected $infomarket;

    /**
     * @var boolean
     */
    protected $infoprodukt;


    /**
     * Set infomarket
     *
     * @param boolean $infomarket
     *
     * @return Simple
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
     * @return Simple
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
}
