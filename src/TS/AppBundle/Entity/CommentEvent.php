<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * CommentEvent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CommentEvent
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
     * @var integer
     *
     * @ORM\Column(name="mark", type="integer", length=255, nullable=true)
     */
    private $mark;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer", length=255, nullable=true)
     */
    private $likes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=255, nullable=true)
     */
    private $comment;
    
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
     * Set mark
     *
     * @param integer $mark
     * @return CommentEvent
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return integer 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     * @return CommentEvent
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer 
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return CommentEvent
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return CommentEvent
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
     * Set event
     *
     * @param \TS\AppBundle\Entity\Event $event
     * @return CommentEvent
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
     * @return CommentEvent
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
