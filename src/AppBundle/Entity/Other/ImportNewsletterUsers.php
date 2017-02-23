<?php

namespace AppBundle\Entity\Other;



/**
 * ImportNewsletterUsers
 */
class ImportNewsletterUsers
{
    /**
     * @var string
     */
    private $importFile;
    
    /**
     * @var array
     */
    private $newsletterGroups;

    /**
     * Set importFile
     *
     * @param string $importFile
     *
     * @return ImportNewsletterUsers
     */
    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;

        return $this;
    }

    /**
     * Get importFile
     *
     * @return string
     */
    public function getImportFile()
    {
        return $this->importFile;
    }
    
    /**
     * Set newsletterGroups
     *
     * @param array $newsletterGroups
     *
     * @return ImportNewsletterUsers
     */
    public function setNewsletterGroups($newsletterGroups)
    {
    	$this->newsletterGroups = $newsletterGroups;
    
    	return $this;
    }
    
    /**
     * Get newsletterGroups
     *
     * @return array
     */
    public function getNewsletterGroups()
    {
    	return $this->newsletterGroups;
    }
}
