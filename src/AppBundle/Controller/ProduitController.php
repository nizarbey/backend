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
use AppBundle\Representation\ProduitPage;

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
    
     /**
     * @Rest\Get(
     *     path = "/categories/{id}/product",
     *     name = "app_prodit_show",
     *     requirements = {"id"="\d+"}
     * )
     */
     /**
     * @Rest\Get(
     *     path = "/categories/{id}/product",
     *     name = "app_prodit_show",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="2",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     * @Rest\View()
     */
    public function listProduitsByCategorieAction(Categorie $categorie, ParamFetcherInterface $paramFetcher)
    {
        //var_dump($categorie->getId()); die();
        $produits = $this->get('Doctrine')
                         ->getManager()
                         ->getRepository('AppBundle:Produit');
                         //->findByCategorie($categorie);
        $pager = $produits->search(
            $categorie ,  
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );
        return new ProduitPage($pager);
    }
}
