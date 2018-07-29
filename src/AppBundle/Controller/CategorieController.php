<?php

/**
 * Description of CategorieController
 *
 * @author LENOVO
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CategorieController extends Controller {
    /**
     * @Route("/categories", name="categorie_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        $categorie = $this->get('serializer')->deserialize($data, 'AppBundle\Entity\Categorie', 'json');
        //var_dump ($categorie);        die();
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
