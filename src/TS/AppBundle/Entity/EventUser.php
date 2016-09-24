<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use TS\UserBundle\Entity\User;

/**
 * EventUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TS\AppBundle\Entity\EventUserRepository")
 */
class EventUser
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
     * @ORM\ManyToOne(targetEntity="TS\AppBundle\Entity\Event")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="TS\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var float
     *
     * @ORM\Column(name="count", type="float")
     */
    private $count=1;

    /**
     * @var float
     *
     * @ORM\Column(name="status", type="float")
     */
    private $status;


    /**
     * @var string
     *
     * @ORM\Column(name="enabled", type="string", length=255)
     */
    private $enabled =1;



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
     * Set count
     *
     * @param float $count
     * @return EventUser
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *  
     * @return float 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set status
     *
     * @param float $status
     * @return EventUser
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return float 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set enabled
     *
     * @param string $enabled
     * @return EventUser
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return string 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set event
     *
     * @param \TS\AppBundle\Entity\Event $event
     * @return EventUser
     */
    public function setEvent(\TS\AppBundle\Entity\Event $event)
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

    /**
     * Set user
     *
     * @param \TS\UserBundle\Entity\User $user
     * @return EventUser
     */
    public function setUser(\TS\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \TS\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
