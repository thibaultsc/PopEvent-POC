<?php


namespace TS\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TS\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

// Liste des noms de catégorie à ajouter
    $mainUsers = array(
        array ('Florence1', 'florence@frip.com', 'motdepasse', '+3399999','ROLE_ADMIN'),
        array ('Thibault', 'thibault@frip.com', 'motdepasse', '+3399999', 'ROLE_SUPER_ADMIN'),
        array ('Antoine1', 'antoine@frip.com', 'motdepasse', '+3399999', 'ROLE_USER')
        );
  
    foreach ($mainUsers as $mainUser) {
      // On crée la catégorie
      $user = new User();
      $user->setUsername($mainUser[0]);
      $user->setPlainPassword($mainUser[2]);
      $user->setPhoneNumber($mainUser[3]);
      $user->setEmail($mainUser[1]);
      $user->setEnabled(true);
      $user->setRoles(array($mainUser[4]));
      
      // On la persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement de toutes les catégories
     $manager->flush();
  }
}