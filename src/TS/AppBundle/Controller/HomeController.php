<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
            // On récupère le repository
        $eventRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:Event')
        ;
        $events = $eventRepository->findBy(array('enabled' => true),array('dateEvent' => 'ASC'),24,0);
        return $this->render('TSAppBundle:Home:index.html.twig', array('events' => $events));
    }
        public function helpAction()
    {

        return $this->render('TSAppBundle:Home:help.html.twig');
    }
}
