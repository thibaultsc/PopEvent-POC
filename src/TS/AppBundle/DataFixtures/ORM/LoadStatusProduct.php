<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\AppBundle\Entity\StatusProduct;

class LoadStatusProduct implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainStatusProducts = array(
     	'En cours de création',
	'En cours de validation',
	'Disponible à la vente',
	'Indisponible à la vente',
	'Disponible à la vente et associé avec un antivol',
	'Vendu',
	'Vendu et détachable',
	'Vendu et détaché',
	'Refusé à la vente',
	'Disponible à la vente par correspondance post-event',
	'Disparu durant l’évènement'
    );
  
    foreach ($mainStatusProducts as $mainStatusProduct) {
      // On crée la catégorie
      $statusProduct = new StatusProduct();
      $statusProduct->setName($mainStatusProduct);
      // On la persiste
      $manager->persist($statusProduct);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}