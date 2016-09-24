<?php

namespace TS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use TS\AppBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;
use TS\AppBundle\Entity\Product;
use TS\AppBundle\Entity\ProductUser;
use TS\AppBundle\Entity\EventProduct;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Security("has_role('ROLE_USER')")
 */
class ProductController extends Controller
{
  
  public function viewAction($id,Request $request)
  {

      $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->findOneProductByIdFullInfo($id);
        $user=$this->getUser();
        
      $qrCode = $request->query->get('qrCode');  
      if ($qrCode==$product->getQrCode())
      {
          $scan = 1;
      }
      else
      {
          $scan =0;
      }
        
        $productUserRepository = $em->getRepository('TSAppBundle:ProductUser');
        $productUser =$productUserRepository->findOneBy(array('user'=>$user,'product'=>$product));
        if (null!==$user) {
            if (null==$productUser) {
                $productUser = new ProductUser();
                $productUser->setUser($user);
                $productUser->setProduct($product);
                $productUser->setLikes(0);
                $productUser->setCount(1);
                $productUser->setStatus(0);
            }
            else 
            {
                $productUser->setCount($productUser->getCount()+1);
            }
            $em->persist($productUser);
            $em->flush();
        }
        return $this->render('TSAppBundle:Product:view.html.twig', array('product' => $product,'productuser' => $productUser,'scan' => $scan, ));
  }
  
 /**
  *  @Security("has_role('ROLE_USER')")
  */
    public function likeAction($id)
  {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->findOneById($id);
        $user=$this->getUser();
        
        $productUserRepository = $em->getRepository('TSAppBundle:ProductUser');
        $productUser =$productUserRepository->findOneBy(array('user'=>$user,'product'=>$product));
        
        if (null==$productUser) {
            $productUser = new ProductUser();
            $productUser->setUser($user);
            $productUser->setProduct($product);
            $productUser->setLikes(1);
            $productUser->setCount(0);
            $productUser->setStatus(0);
        }
        else 
        {
            if ($productUser->getLikes() == 1) {$productUser->setLikes(2);}
            else {$productUser->setLikes(1);}
            $productUser->setCount($productUser->getCount()+1);
        }
        $em->persist($productUser);
        $em->flush();
        return new Response('');
  }
 /**
  *  @Security("has_role('ROLE_USER')")
  */
    public function associateAction($id,$qrCode)
  {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->findOneById($id);
        $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
        $statusProduct = $statusProductRepository->findOneByName('Disponible à la vente et associé avec un antivol');
        
        $user=$this->getUser();
        $salesman = $product->getSalesman();
                
        if ($salesman == $user) {
            $product->setQrCode($qrCode);
            $product->setStatusProduct($statusProduct);
            $em->persist($product);
            $em->flush();
            return new Response($this->generateUrl('ts_app_product_view', array('id' => $product->getId())));
        }

        
        return new Response('');
  }
  
 /**
  *  @Security("has_role('ROLE_USER')")
  */
    public function confirmAction($id)
  {
        $em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->findOneById($id);
        $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
        $statusProduct = $statusProductRepository->findOneByName('En cours de validation');
        
        $user=$this->getUser();
        $salesman = $product->getSalesman();
                
        if ($salesman == $user) {
            $product->setStatusProduct($statusProduct);
            $em->persist($product);
            
            $eventUserRepository = $em->getRepository('TSAppBundle:EventUser');
            //Attention, que ce passe t'il quand le user passe à 11 (enregistrer le jour de l'évènement)
            $eventUsers = $eventUserRepository->findBy(array('user' => $user, 'status' => array(10, 11)));
            
            foreach ($eventUsers as  $eventUser) {
                $event = $eventUser->getEvent();
                $eventProduct = new EventProduct();
                $eventProduct->setEvent($event);
                $eventProduct->setProduct($product);
                // On la persiste
                $em->persist($eventProduct);
            }
            
            $em->flush();
            return new Response($this->generateUrl('ts_app_product_view', array('id' => $product->getId())));
        }

        
        return new Response('');
  }
  
  /**
  *  @Security("has_role('ROLE_ADMIN')")
  */
    public function validateAction()
  {
        $em = $this->getDoctrine()->getManager();
        $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
        $statusProduct = $statusProductRepository->findOneByName('En cours de validation');
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $products = $productRepository->findBy(array('statusProduct' => $statusProduct, 'enabled' => true));

    return $this->render('TSAppBundle:Product:validate.html.twig', array(
      'products' => $products,
      'statusproduct' => $statusProduct,
    ));
  }
    /**
  *  @Security("has_role('ROLE_ADMIN')")
  */
    public function validateokAction($id)
  {
        $em = $this->getDoctrine()->getManager();
        $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
        $statusProduct = $statusProductRepository->findOneByName('Disponible à la vente');
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->find($id);
        $product->setStatusProduct($statusProduct);
      $em->persist($product);
      $em->flush();

    return new Response('');
  }
    /**
  *  @Security("has_role('ROLE_ADMIN')")
  */
    public function validatenokAction($id)
  {
        $em = $this->getDoctrine()->getManager();
        $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
        $statusProduct = $statusProductRepository->findOneByName('Refusé à la vente');
        $productRepository = $em->getRepository('TSAppBundle:Product');
        $product = $productRepository->find($id);
        $product->setStatusProduct($statusProduct);
      $em->persist($product);
      $em->flush();

    return new Response('');
  }
  
/**
 * @Security("has_role('ROLE_USER')")
 */
  public function qrAction($qrCode)
  {
            // On récupère le repository
        $productRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:Product');

        $product = $productRepository->findOneByQrCode($qrCode);
        
        if (null !== $product) {
            return $this->redirect($this->generateUrl('ts_app_product_view', array('id' => $product->getId(), 'qrCode' => $qrCode)));
        }
        $statusProductRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:StatusProduct');
        
        $status = $statusProductRepository->findOneByName('Disponible à la vente');
        
        $user =$this->getUser();
        $products = $productRepository->findBy(array('salesman'=>$user,'statusProduct'=>$status, 'enabled' => true));
        
     return $this->render('TSAppBundle:Product:associate.html.twig', array(
      'qrCode' => $qrCode,
      'products' => $products
    ));
    
  }
  
  
 public function addAction(Request $request)
    {
      // On crée un objet Advert
    $product = new Product();
    $form = $this->get('form.factory')->create(new ProductType(), $product);

      // On fait le lien Requête <-> Formulaire
    // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
    $form->handleRequest($request);

    // On vérifie que les valeurs entrées sont correctes
    // (Nous verrons la validation des objets en détail dans le prochain chapitre)
    if ($form->isValid()) {
      // On l'enregistre notre objet $advert dans la base de données, par exemple        
        $em = $this->getDoctrine()->getManager();
      $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
      $statusProduct = $statusProductRepository->findOneByName("En cours de création");
      $product ->setStatusProduct($statusProduct);
      $user = $this->getUser();
      $product ->setSalesman($user);
      $em->persist($product);
      $em->flush();
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // On redirige vers la page de visualisation de l'annonce nouvellement créée
      return $this->redirect($this->generateUrl('ts_app_product_view', array('id' => $product->getId())));
    }
    
    // À ce stade, le formulaire n'est pas valide car :
    // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
    // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
    return $this->render('TSAppBundle:Product:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }
  
  public function listuserAction()
  {
            // On récupère le repository
        $productRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:Product');
        $products = $productRepository->findBy(array('salesman'=>$this->getUser(),'enabled'=>true));
        
        $statusProductRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:StatusProduct');
        $statusProducts = $statusProductRepository->findAll();

    return $this->render('TSAppBundle:Product:listuser.html.twig', array(
      'products' => $products,
      'statusproducts' => $statusProducts,
    ));
  }
  
    public function wishlistAction()
  {
            // On récupère le repository
        $productUserRepository = $this->getDoctrine()
          ->getManager()
          ->getRepository('TSAppBundle:ProductUser');
        $productUsers = $productUserRepository->findBy(array('user'=>$this->getUser(),'likes'=>1,));
        

    return $this->render('TSAppBundle:Product:wishlist.html.twig', array(
      'productusers' => $productUsers,
    ));
  }
    public function deleteAction($id)
  {
    $productRepository = $this->getDoctrine()
      ->getManager()
      ->getRepository('TSAppBundle:Product');
    $product = $productRepository->findOneById($id);

    if ($product->getSalesman() == $this->getUser()) {
    $product->setEnabled(false);
    $em = $this->getDoctrine()->getManager();
    $em->persist($product);
    $em->flush();
    }
    return new RedirectResponse($this->generateUrl('ts_app_home'));
  }
    public function editAction($id)
  {
    $productRepository = $this->getDoctrine()
      ->getManager()
      ->getRepository('TSAppBundle:Product');
    $product = $productRepository->findOneById($id);

    if ($product->getSalesman() == $this->getUser()) {
    return $this->render('TSAppBundle:Event:edit.html.twig', array(
      'text' => "ici, tu pourras modifier un produit"
    ));
    }
    return new RedirectResponse($this->generateUrl('ts_app_home'));
  }
  
   /**
   * @Security("has_role('ROLE_USER')")
   */
  public function purchaseAction($id)
  {
    $em =   $this->getDoctrine()->getManager();  
    $productRepository = $em
      ->getRepository('TSAppBundle:Product');
    $product = $productRepository->findOneById($id);
    
    $user = $this->getUser();
    $productUser = new ProductUser();
    
    if (null !== $user) {

        $productUserRepository = $em
          ->getRepository('TSAppBundle:ProductUser');
        $productUser = $productUserRepository->findOneBy(array('user' => $user, 'product' => $product));

        if (null == $productUser) {
            $productUser = new ProductUser ();
            $productUser->setProduct($product);
            $productUser->setUser($user);
            $productUser->setLikes(1);
            $productUser->setCount(1);
            $productUser->setStatus(1);
        }
        else
        {
            if ($productUser->getStatus() == 0) 
            { 
                $productUser->setStatus(1);
            }
            $productUser->setCount($productUser->getCount()+1);
        }

        $em->persist($productUser);
        $em->flush();
    }
    //return new RedirectResponse($this->generateUrl('fos_user_register'));
    
    return $this->render('TSAppBundle:Product:purchase.html.twig', array(
      'product' => $product,
      'productUser' => $productUser,
    ));
    
    
  }
  
  /**
   * @Security("has_role('ROLE_USER')")
   */
  public function paidAction($id)
  {
    $em =   $this->getDoctrine()->getManager();  
    $productRepository = $em
      ->getRepository('TSAppBundle:Product');
    $product = $productRepository->findOneById($id);
    
    $user = $this->getUser();
    $productUser = new ProductUser();
    
    if (null !== $user) {

        $productUserRepository = $em
          ->getRepository('TSAppBundle:ProductUser');
        $productUser = $productUserRepository->findOneBy(array('user' => $user, 'product' => $product));

        if (null == $productUser) {
            return new RedirectResponse($this->generateUrl('ts_app_home'));
        }
        else
        {
            $productUser->setStatus(10);
            $productUser->setCount($productUser->getCount()+1);
            $statusProductRepository = $em->getRepository('TSAppBundle:StatusProduct');
            $statusProduct = $statusProductRepository->findOneByName("Vendu");
            $product->setStatusProduct($statusProduct);
        }

        $em->persist($productUser);
        $em->persist($product);
        $em->flush();
    }
    return $this->redirect($this->generateUrl('ts_app_product_purchase', array('id' => $product->getId())));
  }
}