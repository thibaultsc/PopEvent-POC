<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TS\AppBundle\Entity\EventRepository")
 */
class Event
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateBegin", type="datetime")
     */
    private $dateBegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime")
     */
    private $dateEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxPlaces", type="integer")
     */
    private $maxPlaces = 10000;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="datetime")
     */
    private $dateEvent;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="dateHoraire", type="integer")
     */
    private $dateHoraire;

    /**
     * @var integer
     *
     * @ORM\Column(name="maxSalesmans", type="integer", nullable=true)
     */
    private $maxSalesmans;

    /**
     * @var string
     *
     * @ORM\Column(name="maxProducts", type="string", length=255, nullable=true)
     */
    private $maxProducts;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="pricePlace", type="float")
     */
    private $pricePlace;

    /**
     * @var float
     *
     * @ORM\Column(name="priceSalesman", type="float")
     */
    private $priceSalesman;

    /**
     * @var string
     *
     * @ORM\Column(name="placeName", type="string", length=255, nullable=true)
     */
    private $placeName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;
    
    /**
     * @ORM\OneToOne(targetEntity="TS\AppBundle\Entity\Image", cascade={"persist"})
     */
    private $image;
    
    /**
     * @var EventUser[]
     *
     * @ORM\OneToMany(targetEntity = "TS\AppBundle\Entity\EventUser", mappedBy = "event")
     */
    private $eventUsers;

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
     * @return Event
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
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     * @return Event
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime 
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Event
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set maxPlaces
     *
     * @param integer $maxPlaces
     * @return Event
     */
    public function setMaxPlaces($maxPlaces)
    {
        $this->maxPlaces = $maxPlaces;

        return $this;
    }

    /**
     * Get maxPlaces
     *
     * @return integer 
     */
    public function getMaxPlaces()
    {
        return $this->maxPlaces;
    }

    /**
     * Set maxSalesmans
     *
     * @param integer $maxSalesmans
     * @return Event
     */
    public function setMaxSalesmans($maxSalesmans)
    {
        $this->maxSalesmans = $maxSalesmans;

        return $this;
    }

    /**
     * Get maxSalesmans
     *
     * @return integer 
     */
    public function getMaxSalesmans()
    {
        return $this->maxSalesmans;
    }

    /**
     * Set maxProducts
     *
     * @param string $maxProducts
     * @return Event
     */
    public function setMaxProducts($maxProducts)
    {
        $this->maxProducts = $maxProducts;

        return $this;
    }

    /**
     * Get maxProducts
     *
     * @return string 
     */
    public function getMaxProducts()
    {
        return $this->maxProducts;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
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
     * Set pricePlace
     *
     * @param float $pricePlace
     * @return Event
     */
    public function setPricePlace($pricePlace)
    {
        $this->pricePlace = $pricePlace;

        return $this;
    }

    /**
     * Get pricePlace
     *
     * @return float 
     */
    public function getPricePlace()
    {
        return $this->pricePlace;
    }

    /**
     * Set priceSalesman
     *
     * @param float $priceSalesman
     * @return Event
     */
    public function setPriceSalesman($priceSalesman)
    {
        $this->priceSalesman = $priceSalesman;

        return $this;
    }

    /**
     * Get priceSalesman
     *
     * @return float 
     */
    public function getPriceSalesman()
    {
        return $this->priceSalesman;
    }

    /**
     * Set placeName
     *
     * @param string $placeName
     * @return Event
     */
    public function setPlaceName($placeName)
    {
        $this->placeName = $placeName;

        return $this;
    }

    /**
     * Get placeName
     *
     * @return string 
     */
    public function getPlaceName()
    {
        return $this->placeName;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }


    /**
     * Set dateHoraire
     *
     * @param integer $dateHoraire
     * @return Event
     */
    public function setDateHoraire($dateHoraire)
    {
        $this->dateHoraire = $dateHoraire;

        return $this;
    }

    /**
     * Get dateHoraire
     *
     * @return integer 
     */
    public function getDateHoraire()
    {
        return $this->dateHoraire;
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
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     * @return Event
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime 
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
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
        $this->eventUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add eventUsers
     *
     * @param \TS\AppBundle\Entity\EventUser $eventUsers
     * @return Event
     */
    public function addEventUser(\TS\AppBundle\Entity\EventUser $eventUsers)
    {
        $this->eventUsers[] = $eventUsers;

        return $this;
    }

    /**
     * Remove eventUsers
     *
     * @param \TS\AppBundle\Entity\EventUser $eventUsers
     */
    public function removeEventUser(\TS\AppBundle\Entity\EventUser $eventUsers)
    {
        $this->eventUsers->removeElement($eventUsers);
    }

    /**
     * Get eventUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventUsers()
    {
        return $this->eventUsers;
    }
}
