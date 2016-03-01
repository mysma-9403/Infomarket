<?php

namespace AppBundle\Entity\Lists\Base;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class SimpleEntityList
{
	protected $entries;

	public function __construct()
	{
		$this->entries = new ArrayCollection();
	}

    /**
     * Add entry
     *
     * @param $entry
     *
     * @return SimpleEntityList
     */
    public function addEntry($entry)
    {
        $this->entries[] = $entry;

        return $this;
    }

    /**
     * Remove entry
     *
     * @param $entry
     */
    public function removeEntry($entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Get entries
     *
     * @return Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
