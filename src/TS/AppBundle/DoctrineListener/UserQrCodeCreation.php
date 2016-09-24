<?php
// src/OC/PlatformBundle/DoctrineListener/ApplicationNotification.php

namespace TS\AppBundle\DoctrineListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use TS\UserBundle\Entity\User;
use TS\AppBundle\Entity\Image;
use RandomLib\Generator;

class UserQrCodeCreation
{
    const KEY_SIZE = 10;
    const KEY_CHARACTERS = '0123456789';

    private $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }


  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();

    // On veut envoyer un email que pour les entités Application
    if (!$entity instanceof User) {
      return;
    }
    $qrCode = $this->generateRandomQrCode($args);
    $entity->setQrCode($qrCode);
    //$entity = $this->generateRandomQrCodeImage($entity );
    
  }


    private function generateRandomQrCode(LifecycleEventArgs $args)
    {
        $em = $args->getEntityManager();
        $qrCode = $this->generator->generateString(self::KEY_SIZE, self::KEY_CHARACTERS);
        //$qrCode = "test";
        if ($em->getRepository('TSUserBundle:User')->findOneBy(['qrCode' => $qrCode])) {
            return $this->generateRandomQrCode();
        }
        return $qrCode;
    }

    private function generateRandomQrCodeImage(User $entity)
    {
        
        $qrCode=$entity->getQrCode();
        $racine = "dt2.eu";
        $image = "http://localhost/fripery/web/app_dev.php/qrcode/http://".$racine."/".$qrCode.".png";
        // Ouvre un fichier pour lire un contenu existant
        $current = file_get_contents($image);
        // Écrit le résultat dans le fichier
        
        $qrCodeImage = "bundles/User/qrCode/".$racine."-".$qrCode.".png";
        file_put_contents($qrCodeImage, $current);
        
        $image2 = new Image();
        $image2->setUrl($qrCodeImage);
        $image2->setAlt($qrCode);
        
        $entity->setQrCodeImage($image2);
        
        return $entity;
    }
    
  
}