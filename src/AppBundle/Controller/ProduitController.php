<?php

/**
 * Description of ProduitController
 *
 * @author LENOVO
 */
namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use AppBundle\Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;

class ProduitController extends Controller {
    
    /**
     * @Rest\Post(
     *    path = "/produits",
     *    name = "app_produit_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("produit", converter="fos_rest.request_body")
     */
    public function createAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->merge($produit);
        $em->flush();

        return $produit;
    }
}
