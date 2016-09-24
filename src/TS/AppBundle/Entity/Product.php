<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TS\AppBundle\Entity\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\SizeProduct")
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Brand")
     * @ORM\JoinColumn(nullable=true)
     */
    private $brand;
    
    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\StatusProduct")
     * @ORM\JoinColumn(nullable=false)
     */
    private $statusProduct;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Quality")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quality;
    
    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Color")
     * @ORM\JoinColumn(nullable=true)
     */
    private $color;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="TS\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $salesman;

    /**
     * @ORM\OneToOne(targetEntity="TS\AppBundle\Entity\Image", cascade={"persist"})
     */
    private $image;
    
    /**
     * @var string
     *
     * @ORM\Column(name="qrcode", type="string", unique=true, nullable=true)
     */
    private $qrCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled = true;
   
    /**
     * @var ProductUser[]
     *
     * @ORM\OneToMany(targetEntity = "TS\AppBundle\Entity\ProductUser", mappedBy = "product")
     */
    private $productUsers;
    
    /**
     * @var EventProduct[]
     *
     * @ORM\OneToMany(targetEntity = "TS\AppBundle\Entity\EventProduct", mappedBy = "product")
     */
    private $eventProducts;
    
    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="photo", fileNameProperty="photoName")
     * @Assert\Image
     */
    private $photoFile;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="image_name", nullable=true)
     */
    private $photoName;
    

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
     * @return Product
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
     * @return Product
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
     * Set price
     *
     * @param float $price
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
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set size
     *
     * @param \TS\AppBundle\Entity\SizeProduct $size
     * @return Product
     */
    public function setSize(\TS\AppBundle\Entity\SizeProduct $size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return \TS\AppBundle\Entity\SizeProduct 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set category
     *
     * @param \TS\AppBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\TS\AppBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \TS\AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set brand
     *
     * @param \TS\AppBundle\Entity\Brand $brand
     * @return Product
     */
    public function setBrand(\TS\AppBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \TS\AppBundle\Entity\Brand 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set statusProduct
     *
     * @param \TS\AppBundle\Entity\StatusProduct $statusProduct
     * @return Product
     */
    public function setStatusProduct(\TS\AppBundle\Entity\StatusProduct $statusProduct)
    {
        $this->statusProduct = $statusProduct;

        return $this;
    }

    /**
     * Get statusProduct
     *
     * @return \TS\AppBundle\Entity\StatusProduct 
     */
    public function getStatusProduct()
    {
        return $this->statusProduct;
    }

    /**
     * Set quality
     *
     * @param \TS\AppBundle\Entity\Quality $quality
     * @return Product
     */
    public function setQuality(\TS\AppBundle\Entity\Quality $quality)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality
     *
     * @return \TS\AppBundle\Entity\Quality 
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set salesman
     *
     * @param \TS\UserBundle\Entity\User $salesman
     * @return Product
     */
    public function setSalesman(\TS\UserBundle\Entity\User $salesman)
    {
        $this->salesman = $salesman;

        return $this;
    }

    /**
     * Get salesman
     *
     * @return \TS\UserBundle\Entity\User 
     */
    public function getSalesman()
    {
        return $this->salesman;
    }
    /**
     * Set image
     *
     * @param \TS\AppBundle\Entity\Image $image
     * @return Event
     */
    public function setImage(\TS\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \TS\AppBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    

    /**
     * Set qrCode
     *
     * @param string $qrCode
     * @return Product
     */
    public function setQrCode($qrCode)
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    /**
     * Get qrCode
     *
     * @return string 
     */
    public function getQrCode()
    {
        return $this->qrCode;
    }
    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Event
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
     * Constructor
     */
    public function __construct()
    {
        $this->productUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add productUsers
     *
     * @param \TS\AppBundle\Entity\ProductUser $productUsers
     * @return Product
     */
    public function addProductUser(\TS\AppBundle\Entity\ProductUser $productUsers)
    {
        $this->productUsers[] = $productUsers;

        return $this;
    }

    /**
     * Remove productUsers
     *
     * @param \TS\AppBundle\Entity\ProductUser $productUsers
     */
    public function removeProductUser(\TS\AppBundle\Entity\ProductUser $productUsers)
    {
        $this->productUsers->removeElement($productUsers);
    }

    /**
     * Get productUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProductUsers()
    {
        return $this->productUsers;
    }

    /**
     * Add eventProducts
     *
     * @param \TS\AppBundle\Entity\EventProduct $eventProducts
     * @return Product
     */
    public function addEventProduct(\TS\AppBundle\Entity\EventProduct $eventProducts)
    {
        $this->eventProducts[] = $eventProducts;

        return $this;
    }

    /**
     * Remove eventProducts
     *
     * @param \TS\AppBundle\Entity\EventProduct $eventProducts
     */
    public function removeEventProduct(\TS\AppBundle\Entity\EventProduct $eventProducts)
    {
        $this->eventProducts->removeElement($eventProducts);
    }

    /**
     * Get eventProducts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventProducts()
    {
        return $this->eventProducts;
    }

    /**
     * Set color
     *
     * @param \TS\AppBundle\Entity\Color $color
     * @return Product
     */
    public function setColor(\TS\AppBundle\Entity\Color $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \TS\AppBundle\Entity\Color 
     */
    public function getColor()
    {
        return $this->color;
    }
    
     /**
     * @param  File     $photoFile
     * @return Purchase
     */
    public function setPhotoFile(File $photoFile)
    {
        $this->photoFile = $photoFile;

        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @param  string   $photoName
     * @return Purchase
     */
    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhotoName()
    {
        return $this->photoName;
    }


}
