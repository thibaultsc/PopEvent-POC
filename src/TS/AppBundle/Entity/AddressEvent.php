<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use TS\AppBundle\Entity\Event;
use TS\AppBundle\Entity\Address;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * AddressEvent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class AddressEvent
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
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Address")
     * @ORM\JoinColumn(nullable=false)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Event")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @var string
     *
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;


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
     * Set information
     *
     * @param string $information
     * @return AddressEvent
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set address
     *
     * @param \TS\AppBundle\Entity\Address $address
     * @return AddressEvent
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \TS\AppBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set event
     *
     * @param \TS\AppBundle\Entity\Event $event
     * @return AddressEvent
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \TS\AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
