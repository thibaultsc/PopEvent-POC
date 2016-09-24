<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TS\AppBundle\Entity\CategoryRepository")
 */
class Category
{
    use TimestampableEntity;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parent;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="sizeType", type="integer")
     */
    private $sizeType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled = true;

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
     * Set name
     *
     * @param string $name
     * @return Category
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Category
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }




    /**
     * Set parent
     *
     * @param \TS\AppBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\TS\AppBundle\Entity\Category $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \TS\AppBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set sizeType
     *
     * @param integer $sizeType
     * @return Category
     */
    public function setSizeType($sizeType)
    {
        $this->sizeType = $sizeType;

        return $this;
    }

    /**
     * Get sizeType
     *
     * @return integer 
     */
    public function getSizeType()
    {
        return $this->sizeType;
    }
}
