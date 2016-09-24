<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use TS\AppBundle\Entity\Event;
use TS\AppBundle\Entity\Image;
use TS\AppBundle\Entity\EventProduct;
use TS\AppBundle\Form\EventType;
use TS\AppBundle\Entity\EventUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;


class EventController extends Controller
{
    
  public function listAction()
  {
            // On récupère le repository
        $eventRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:Event');
        $events = $eventRepository->findBy(array('enabled' => true),array('dateEvent' => 'ASC'),10,0);;

    return $this->render('TSAppBundle:Event:list.html.twig', array(
      'events' => $events
    ));
  }
  
    public function listuserAction()
  {
            // On récupère le repository
        $eventUserRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:EventUser');
        $user = $this->getUser();
        $eventUsers = $eventUserRepository->findByUserAndStatusOrderByDate($user,10,11);
                //findBy(array('user'=>$this->getUser(), 'status'=>10),array(),10,0);

    return $this->render('TSAppBundle:Event:listuser.html.twig', array(
      'eventUsers' => $eventUsers
    ));
  }

  
  public function viewAction($id)
  {
        // On récupère le repository
    $em =   $this->getDoctrine()->getManager();  
    $eventRepository = $em->getRepository('TSAppBundle:Event');
    $eventUserRepository = $em->getRepository('TSAppBundle:EventUser');
    $productRepository = $em->getRepository('TSAppBundle:Product');
    
    $event = $eventRepository->findOneById($id);

    
        
        
        if ( null !== $user = $this->getUser()){

            $eventUser = $eventUserRepository->findOneBy(array('user' => $user, 'event' => $event));
            if (null == $eventUser) {
                $eventUser = new EventUser ();
                $eventUser->setEvent($event);
                $eventUser->setUser($this->getUser());
                $eventUser->setStatus(0);
                $eventUser->setCount(1);
            }
            else
            {
                $eventUser->setCount($eventUser->getCount()+1);
            }
            $em->persist($eventUser);
            $em->flush();
        }


      
      $eventUser = isset($eventUser) && $eventUser ? $eventUser : null; 

      $nbPerPage = 8;
      
      $productfulls = $productRepository->findProductsForEventWithUser($event,1, $nbPerPage);
      
      $eventUsers = $eventUserRepository->findByEvent($event);
     
      $now = new \DateTime();
      $counterdays = $now->diff($event->getDateEnd())->days ;
      $counterusers = $event->getMaxPlaces()- count($eventUsers);
     
        
    return $this->render('TSAppBundle:Event:view.html.twig', array(
      'event' => $event,
      //'eventProducts' => $eventProducts,
        'eventUser' => $eventUser,
        'productfulls' =>$productfulls,
        'counterdays' =>$counterdays,
        'counterusers' => $counterusers,
    ));
  }
   /**
   * @Security("has_role('ROLE_USER')")
   */
  public function productAction($id,Request $request)
  {
    $page = $request->query->get('page');  
      if ($page < 1) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }
        // On récupère le repository
    $em =   $this->getDoctrine()->getManager();  
    $eventRepository = $em->getRepository('TSAppBundle:Event');
    $event = $eventRepository->findOneById($id);
        
    $eventProductRepository = $em->getRepository('TSAppBundle:EventProduct');
    $eventProducts = $eventProductRepository->findBy(array('event' => $event));
        

        
        if ( null !== $this->getUser()){
            $eventUserRepository = $this->getDoctrine()
                ->getManager()
                ->getRepository('TSAppBundle:EventUser');
            $eventUser = $eventUserRepository->findOneBy(array('user' => $this->getUser(), 'event' => $event));
            if (null == $eventUser) {
                $eventUser = new EventUser ();
                $eventUser->setEvent($event);
                $eventUser->setUser($this->getUser());
                $eventUser->setStatus(0);
                $eventUser->setCount(1);
            }
            else
            {
                $eventUser->setCount($eventUser->getCount()+1);
            }
            $em->persist($eventUser);
            $em->flush();
        }
      $nbPerPage = 48;
    $productRepository = $em->getRepository('TSAppBundle:Product');
   $productfulls = $productRepository->findProductsForEventWithUser($event,$page, $nbPerPage);      
   $nbPages = ceil(count($productfulls)/$nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages) {
        if ($page > 1) {
      throw $this->createNotFoundException("La page ".$page." n'exidste pas.");
        }
    }
      
        
    return $this->render('TSAppBundle:Event:product.html.twig', array(
      'event' => $event,
      'eventProducts' => $eventProducts,
        'eventUser' => $eventUser,
        'productfulls' =>$productfulls,
        'nbPages'     => $nbPages,
        'page'        => $page
    ));
  }
  
  
   /**
   * @Security("has_role('ROLE_ADMIN')")
   */
    public function addAction(Request $request)
    {

      $event = new Event();
      $form = $this->get('form.factory')->create(new EventType(), $event);
      // On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);

    // On vérifie que les valeurs entrées sont correctes
    // (Nous verrons la validation des objets en détail dans le prochain chapitre)
    if ($form->isValid()) {
      // On l'enregistre notre objet $advert dans la base de données, par exemple
      $em = $this->getDoctrine()->getManager();
      $em->persist($event);
      
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('ts_app_event_view', array('id' => $event->getId())));
    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('TSAppBundle:Event:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
  
   /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction($id)
  {
    $eventRepository = $this->getDoctrine()
      ->getManager()
      ->getRepository('TSAppBundle:Event');
    $event = $eventRepository->findOneById($id);

    $event->setEnabled(false);
    $em = $this->getDoctrine()->getManager();
    $em->persist($event);
    $em->flush();

    return new RedirectResponse($this->generateUrl('ts_app_home'));
  }
 

  public function subscribeAction($id)
  {
    $em =   $this->getDoctrine()->getManager();  
    $eventRepository = $em
      ->getRepository('TSAppBundle:Event');
    $event = $eventRepository->findOneById($id);
    
    $user = $this->getUser();
    $eventUser = new EventUser();
    
    if (null !== $user) {

        $eventUserRepository = $em
          ->getRepository('TSAppBundle:EventUser');
        $eventUser = $eventUserRepository->findOneBy(array('user' => $user, 'event' => $event));

        if (null == $eventUser) {
            $eventUser = new EventUser ();
            $eventUser->setEvent($event);
            $eventUser->setUser($user);
            $eventUser->setStatus(1);
            $eventUser->setCount(1);
        }
        else
        {
            if ($eventUser->getStatus() == 0) 
            { 
                $eventUser->setStatus(1);
            }
            $eventUser->setCount($eventUser->getCount()+1);
        }

        $em->persist($eventUser);
        $em->flush();
    }
    //return new RedirectResponse($this->generateUrl('fos_user_register'));
    
    return $this->render('TSAppBundle:Event:subscribe.html.twig', array(
      'event' => $event,
      'eventUser' => $eventUser,
    ));
    
    
  }
    /**
   * @Security("has_role('ROLE_USER')")
   */
  public function paidAction($id)
  {
    $em =   $this->getDoctrine()->getManager();  
    $eventRepository = $em
      ->getRepository('TSAppBundle:Event');
    $event = $eventRepository->findOneById($id);
    
    $user = $this->getUser();
    $eventUser = new EventUser();
    
    if (null !== $user) {

        $eventUserRepository = $em
          ->getRepository('TSAppBundle:EventUser');
        $eventUser = $eventUserRepository->findOneBy(array('user' => $user, 'event' => $event));

        if (null == $eventUser) {
            return new RedirectResponse($this->generateUrl('ts_app_home'));
        }
        else
        {
            $eventUser->setStatus(10);
            $eventUser->setCount($eventUser->getCount()+1);
            $productRepository = $em->getRepository('TSAppBundle:Product');
            $products =  $productRepository->findBy(array('salesman' => $user,));
            foreach ($products as $product) {
                $eventProduct = new EventProduct();
                $eventProduct->setProduct($product);
                $eventProduct->setEvent($event);
                $em->persist($eventProduct);
            }

        }

        $em->persist($eventUser);
        $em->flush();
    }
    return $this->redirect($this->generateUrl('ts_app_event_subscribe', array('id' => $event->getId())));
  }
  
   /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction(Request $request, $id)
  {
       $event =  $this->getDoctrine()
        ->getManager()
        ->getRepository('TSAppBundle:Event')
        ->find($id)
            ;
       
      $image = $event->getImage();
      $form = $this->get('form.factory')->create(new EventType(), $event);
      // On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);

    // On vérifie que les valeurs entrées sont correctes
    // (Nous verrons la validation des objets en détail dans le prochain chapitre)
    if ($form->isValid()) {
      // On l'enregistre notre objet $advert dans la base de données, par exemple
      $em = $this->getDoctrine()->getManager();

      $em->persist($event);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('ts_app_event_view', array('id' => $event->getId())));
    }

    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('TSAppBundle:Event:edit.html.twig', array(
            'event' => $event,
      'form' => $form->createView(),
    ));
      
      
      
      

  }
    
    
}
