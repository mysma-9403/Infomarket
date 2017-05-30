<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\Audit;

/**
 * UserCategoryAssignment
 */
class UserCategoryAssignment extends Audit
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Base\Audit::getDisplayName()
	 */
	public function getDisplayName() {
		return $this->user->getDisplayName();
	}
	
    /**
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * @var \AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserCategoryAssignment
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return UserCategoryAssignment
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
