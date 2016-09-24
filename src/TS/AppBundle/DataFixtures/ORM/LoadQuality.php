<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\Quality;

class LoadQuality implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainQualities = array(
     'neuf/jamais porté', 'très bon état', 'quelques marques d’utilisation'
    );
  
    foreach ($mainQualities as $mainQuality) {
      // On crée la catégorie
      $quality = new Quality();
      $quality->setName($mainQuality);
      // On la persiste
      $manager->persist($quality);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}