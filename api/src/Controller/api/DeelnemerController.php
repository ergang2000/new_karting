<?php


namespace App\Controller\api;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class DeelnemerController
 * @package App\Controller\api
 * @Route("/api/user", name="api_user_")
 */
class DeelnemerController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/")
     */
    public function GetCurrentUser() {
        return $this->handleView($this->view($this->getUser()));
    }
}