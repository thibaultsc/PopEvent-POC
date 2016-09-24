<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use TS\AppBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use TS\AppBundle\Entity\Image;
use TS\AppBundle\Entity\ProductUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Security("has_role('ROLE_USER')")
 */
class ImageController extends Controller
{
  /**
 * @Template()
 */
public function uploadAction()
{
    $document = new Image();
    $form = $this->createFormBuilder($document)
        ->add('file')
        ->getForm()
    ;

    if ($this->getRequest()->isMethod('POST')) {
        $form->handleRequest($this->getRequest());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $document->upload();

            $em->persist($document);
            $em->flush();

            $this->redirect('http://google.fr');
        }
    }

    return array('form' => $form->createView());
}

}