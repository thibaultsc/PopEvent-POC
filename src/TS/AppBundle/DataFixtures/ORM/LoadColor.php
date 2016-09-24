<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\Color;

class LoadColor implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainColors = array(
     'Blanc', 'Noir', 'Bleu', 'Jaune', 'Rouge', 'Vert', 'Orange', 'Violet', 'Marron'
    );
  
    foreach ($mainColors as $mainColor) {
      // On crée la catégorie
      $color = new Color();
      $color->setName($mainColor);
      // On la persiste
      $manager->persist($color);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}