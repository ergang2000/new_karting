<?php


namespace App\Controller\api;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class BezoekerController
 * @package App\Controller\api
 * @Route("/api", name="api_")
 */
class BezoekerController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/soortactiviteiten")
     */
    public function getSoort()
    {
        $soorten = $this->getDoctrine()->getRepository('App:Soortactiviteit')->findAll();
        return $this->handleView($this->view($soorten));
    }
}