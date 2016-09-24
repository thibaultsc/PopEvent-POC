<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

  public function profileAction($username)
  {
            // On récupère le repository
        $eventRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSUserBundle:User');
        
        $user =  $eventRepository->findOneByUsername($username);
        
    return $this->render('TSUserBundle:User:profile.html.twig', array('user' => $user));
  }
    
    //manque un controller pour checkin le jour j
}
