<?php

namespace TS\AppBundle\Controller;

use TS\AppBundle\Entity\Product;
use TS\AppBundle\Form\ProductType;

use CoopTilleuls\MonDaronBundle\Form\Type\PurchaseType;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AskController extends Controller
{
    /**
     * @var string[]
     */
    private static $messages = [
        'Mon petit papa chéri, offre moi cette sape ! J\'ai été sage depuis 30 minutes.',
        'Allez mon petit papa, offre moi ça !',
        'Maman, tu es radieuse aujourd\'hui.. Tu m\'achètes ça ? ;)',
        'Papa, j\'ai eu une bonne note à mon DS. Je peux avoir un cadeau ?',
        'Maman, j\'ai fini tous mes devoirs. Je peux avoir une récompense ? ',
        'Papa, je te parie que tu n\'as jamais vu une aussi belle sape. Tu me l\'achètes ?',

    ];

    /**
     * @param  string                                                        $qrCode
     * @param  Request                                                       $request
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\RequestException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|array
     *
     * @Method({"GET", "POST"})
     * @Template
     */
    public function indexAction( Request $request)
    {

        $product = new Product();
        $form = $this->get('form.factory')->create(new ProductType(), $product);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Requête bien enregistrée.');


            $productId= $product->getId();

            return $this->redirect('www.google.fr');
        }

        return [
            'product' => $product,
            'form' => $form->createView()
        ];
    }

    /**
     * @param  Purchase $purchase
     * @return array
     *
     * @Route("/{randomKey}/send")
     * @Method({"GET"})
     * @Template
     */
    public function sendAction(Purchase $purchase)
    {
        return [
            'purchase' => $purchase,
            'messages' => self::$messages,
        ];
    }
}
