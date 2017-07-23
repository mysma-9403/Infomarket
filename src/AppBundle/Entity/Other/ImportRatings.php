<?php

namespace AppBundle\Entity\Other;



/**
 * ImportRatings
 */
class ImportRatings
{
    /**
     * @var string
     */
    private $importFile;

    /**
     * Set importFile
     *
     * @param string $importFile
     *
     * @return ImportRatings
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
}
