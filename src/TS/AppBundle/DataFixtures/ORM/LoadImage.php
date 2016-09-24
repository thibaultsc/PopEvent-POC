<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use TS\AppBundle\Entity\Image;

class LoadImage implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
// Liste des noms de catégorie à ajouter
    $mainImages = array(
      array('/bundles/tsapp/event/Grand-Palais.jpg', 'Grand Palais' ),
      array('/bundles/tsapp/event/Fondation.jpg', 'Fondation LV' ),
      array('/bundles/tsapp/event/Opéra.jpg', 'Opéra Garnier' ),
      array('/bundles/tsapp/event/Lille-Flandres.jpg', 'Lille Flandres' ),
    );
  
    foreach ($mainImages as $mainImage) {
      // On crée la catégorie
      $image = new Image();
      $image->setUrl($mainImage[0]);
      $image->setAlt($mainImage[1]);

      // On la persiste
      $manager->persist($image);
      $manager->flush();
    }

    // On déclenche l'enregistrement de toutes les catégories
    // $manager->flush();
  }
}
