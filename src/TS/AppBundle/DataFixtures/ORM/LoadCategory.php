<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
   $CategoryRepository = $manager->getRepository('TSAppBundle:Category');
// Liste des noms de catégorie à ajouter
    $mainCategories = array(
      array('Femme','1',  ),
      array('Homme','1', ) ,
      array('Top/T-Shirt','1','Femme'),
      array('Robe','1','Femme'),
      array('Pantalon','1','Femme'),
      array('Jean','1','Femme'),
      array('Jupe','1','Femme'),
      array('Pantacourt/Short','1','Femme'),
      array('Chemisier/Tunique','1','Femme'),
      array('Pull/Gilet','1','Femme'),
      array('Veste/Blouson','1','Femme'),
      array('Manteau','1','Femme'),
      array('Souliers','2','Femme'),
      array('Accessoire','3','Femme'),
      array('Bijou','3','Femme'),
      array('Polo/T-Shirt','1','Homme'),
      array('Pantalon','1','Homme'),
      array('Jean','1','Homme'),
      array('Bermuda','1','Homme'),
      array('Chemise','1','Homme'),
      array('Pull/Gilet','1','Homme'),
      array('Veste/Blouson','1','Homme'),
      array('Manteau','1','Homme'),
      array('Sweat','1','Homme'),
      array('Souliers','2','Homme'),
      array('Accessoire','3','Homme'),
      array('Bagagerie','3','Homme')
    );
  
    foreach ($mainCategories as $mainCategory) {
      // On crée la catégorie
      $category = new Category();
      $category->setName($mainCategory[0]);
      $category->setSizeType($mainCategory[1]);
      if (isset($mainCategory[2])){
          $main = $CategoryRepository->findOneByName($mainCategory[2]);
          $category->setParent($main);
      }
      // On la persiste
      $manager->persist($category);
      $manager->flush();
    }

    // On déclenche l'enregistrement de toutes les catégories
    // $manager->flush();
  }
}