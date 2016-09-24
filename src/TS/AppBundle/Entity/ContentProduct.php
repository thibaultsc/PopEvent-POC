<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * ContentProduct
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContentProduct
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
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\ContentType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeContent;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="link", type="integer", length=255, nullable=true)
     */
    private $link;


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
     * Set title
     *
     * @param string $title
     * @return ContentProduct
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ContentProduct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set link
     *
     * @param integer $link
     * @return ContentProduct
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return integer 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set product
     *
     * @param \TS\AppBundle\Entity\Product $product
     * @return ContentProduct
     */
    public function setProduct(\TS\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \TS\AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set typeContent
     *
     * @param \TS\AppBundle\Entity\ContentType $typeContent
     * @return ContentProduct
     */
    public function setTypeContent(\TS\AppBundle\Entity\ContentType $typeContent)
    {
        $this->typeContent = $typeContent;

        return $this;
    }

    /**
     * Get typeContent
     *
     * @return \TS\AppBundle\Entity\ContentType 
     */
    public function getTypeContent()
    {
        return $this->typeContent;
    }
}
