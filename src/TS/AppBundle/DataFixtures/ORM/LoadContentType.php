<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\ContentType;

class LoadContentType implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainContentTypes = array(
     'Photo', 'Video', 'Lien'
    );
  
    foreach ($mainContentTypes as $mainontentType) {
      // On crée la catégorie
      $contentType = new ContentType();
      $contentType->setName($mainontentType);
      // On la persiste
      $manager->persist($contentType);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}