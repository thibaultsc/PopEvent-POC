<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * ContentEvent
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContentEvent
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
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
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
     * @return ContentEvent
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
     * @return ContentEvent
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
     * @param string $link
     * @return ContentEvent
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set event
     *
     * @param \TS\AppBundle\Entity\Event $event
     * @return ContentEvent
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
     * Set typeContent
     *
     * @param \TS\AppBundle\Entity\ContentType $typeContent
     * @return ContentEvent
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
