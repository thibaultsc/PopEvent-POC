<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;


      /**
   * @ORM\Column(name="url", type="string", length=255, nullable=true)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255, nullable=true)
   */
  private $alt;
  
  
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
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

/**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsoluteUrl();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            unlink($this->temp);
        }
    }

    public function getAbsoluteUrl()
    {
        return null === $this->url
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }

    public function getWebUrl()
    {
        return null === $this->url
            ? null
            : $this->getUploadDir().'/'.$this->url;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory url where uploaded
        // images should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'bundles/tsapp/images';
    }
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image url
        if (is_file($this->getAbsoluteUrl())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsoluteUrl();
        } else {
            $this->url = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image url
            $this->temp = null;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->getFile()->guessExtension()
        );

        $this->setFile(null);
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $this->url = $this->getFile()->guessExtension();
        }
    }
}