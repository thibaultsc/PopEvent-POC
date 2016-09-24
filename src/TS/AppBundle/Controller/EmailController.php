<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends Controller
{
    public function userCreatedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepositery = $em->getRepository('TSUserBundle:User');
        $user = $userRepositery->find($id);
        
        $emailFrom = "thibaultsc@gmail.com" ;
        $emailTo = $user->getEmail();
        $subject = "Pop Event : Bienvenue dans notre vide dressing";
        $body = array(" Votre compte a bien été créé",);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('TSAppBundle:Email:userCreated.html.twig', array('body' => $body)), 'text/html')
        ;
        $this->get('mailer')->send($message);

        return $this->render('TSAppBundle:Email:userCreated.html.twig', array('body' => $body));
        //return new Response('Ok');
    }
    
    public function productSoldAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepositery = $em->getRepository('TSUserBundle:User');
        $user = $userRepositery->find($id);
        
        $emailFrom = "thibaultsc@gmail.com" ;
        $emailTo = $user->getEmail();
        $subject = "Pop Event : Votre produit a été vendu";
        $body = array("Votre super produit a été vendu",);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('TSAppBundle:Email:productSold.html.twig', array('body' => $body)), 'text/html')
        ;
        
        $this->get('mailer')->send($message);

        return $this->render('TSAppBundle:Email:productSold.html.twig', array('body' => $body));
        //return new Response('Ok');
    }
    public function productPurchasedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepositery = $em->getRepository('TSUserBundle:User');
        $user = $userRepositery->find($id);
        
        $emailFrom = "thibaultsc@gmail.com" ;
        $emailTo = $user->getEmail();
        $subject = "Pop Event : Vous avez acheté un produit";
        $body = array("Voici un recu pour l'achat de votre produit",);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('TSAppBundle:Email:productPurchased.html.twig', array('body' => $body)), 'text/html')
        ;
        
        $this->get('mailer')->send($message);

        return $this->render('TSAppBundle:Email:productPurchased.html.twig', array('body' => $body));
        //return new Response('Ok');
    }
    public function eventSubscribedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepositery = $em->getRepository('TSUserBundle:User');
        $user = $userRepositery->find(1);
        
        $emailFrom = "thibaultsc@gmail.com" ;
        $emailTo = $user->getEmail();
        $subject = "Pop Event : Vous avez réservé une place pour l'événement";
        $body = array("Sympa, voici votre QR a présenter le jour J",);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('TSAppBundle:Email:eventSubscribed.html.twig', array('body' => $body)), 'text/html')
        ;
        
        $this->get('mailer')->send($message);

        return $this->render('TSAppBundle:Email:eventSubscribed.html.twig', array('body' => $body));
        //return new Response('Ok');
    }
    public function productCreatedAction()
    {
        $em = $this->getDoctrine()->getManager();
        $userRepositery = $em->getRepository('TSUserBundle:User');
        $user = $userRepositery->find(1);
        
        $emailFrom = "thibaultsc@gmail.com" ;
        $emailTo = $user->getEmail();
        $subject = "Pop Event : Votre produit a été validé par le modérateur";
        $body = array("Votre produit est bientôt prêt à la vente",);

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($emailFrom)
            ->setTo($emailTo)
            ->setBody($this->renderView('TSAppBundle:Email:productCreated.html.twig', array('body' => $body)), 'text/html')
        ;
        
        $this->get('mailer')->send($message);

        return $this->render('TSAppBundle:Email:productCreated.html.twig', array('body' => $body));
        //return new Response('Ok');
    }
    
}
