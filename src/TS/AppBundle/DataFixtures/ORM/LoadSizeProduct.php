<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\SizeProduct;

class LoadSizeProduct implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainSizeProducts = array(
        array(1, 'Intl', 'XS', 'Intl',), //Type, région puis equivalence
        array(1, 'Intl', 'S', 'FR',), //Type, région puis equivalence
        array(1, 'Intl', 'M', '3',), //Type, région puis equivalence
        array(1, 'Intl', 'L', '4',), //Type, région puis equivalence
        array(1, 'Intl', 'XL', '5',), //Type, région puis equivalence
        array(1, 'Intl', 'XXL', '6',), //Type, région puis equivalence
        array(1, 'Intl', 'XXS', 'XXS',), //Type, région puis equivalence
        array(1, 'Intl', 'XS', 'XS',), //Type, région puis equivalence
        array(1, 'Intl', 'XS', 'S',), //Type, région puis equivalence
        array(1, 'Intl', 'M', 'M',), //Type, région puis equivalence
        array(1, 'Intl', 'L', 'L',), //Type, région puis equivalence
        array(1, 'Intl', 'XL', 'XL',), //Type, région puis equivalence
        array(1, 'Intl', 'XXL', 'XXL',), //Type, région puis equivalence
        array(1, 'Intl', 'XXXL', 'XXXL',), //Type, région puis equivalence
        array(1, 'FR', 'XXS', '33',), //Type, région puis equivalence
        array(1, 'FR', 'XXS', '34',), //Type, région puis equivalence
        array(1, 'FR', 'XXS', '35',), //Type, région puis equivalence
        array(1, 'FR', 'XS', '36',), //Type, région puis equivalence
        array(1, 'FR', 'XS', '37',), //Type, région puis equivalence
        array(1, 'FR', 'S', '38',), //Type, région puis equivalence
        array(1, 'FR', 'S', '39',), //Type, région puis equivalence
        array(1, 'FR', 'S', '40',), //Type, région puis equivalence
        array(1, 'FR', 'M', '41',), //Type, région puis equivalence
        array(1, 'FR', 'M', '42',), //Type, région puis equivalence
        array(1, 'FR', 'L', '43',), //Type, région puis equivalence
        array(1, 'FR', 'L', '44',), //Type, région puis equivalence
        array(1, 'FR', 'XL', '45',), //Type, région puis equivalence
        array(1, 'FR', 'XL', '46',), //Type, région puis equivalence
        array(2, 'FR', 'FR 35', '35',), //Type, région puis equivalence
        array(2, 'FR', 'FR 36', '36',), //Type, région puis equivalence
        array(2, 'FR', 'FR 37', '37',), //Type, région puis equivalence
        array(2, 'FR', 'FR 38', '38',), //Type, région puis equivalence
        array(2, 'FR', 'FR 39', '39',), //Type, région puis equivalence
        array(2, 'FR', 'FR 40', '40',), //Type, région puis equivalence
        array(2, 'FR', 'FR 41', '41',), //Type, région puis equivalence
        array(3, 'Intl', 'Unique', 'unique')
    );
  
    foreach ($mainSizeProducts as $mainSizeProduct) {
      // On crée la catégorie
      $sizeProduct = new SizeProduct();
      $sizeProduct->setName($mainSizeProduct[3]);
      $sizeProduct->setType($mainSizeProduct[0]);
      $sizeProduct->setRegion($mainSizeProduct[1]);
      $sizeProduct->setEquivalence($mainSizeProduct[2]);
      // On la persiste
      $manager->persist($sizeProduct);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}