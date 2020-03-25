<?php


namespace App\Controller\api;


use App\Entity\Activiteit;
use App\Entity\User;
use App\Form\UserType;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function getSoortIndex()
    {
        $soorten = $this->getDoctrine()->getRepository('App:Soortactiviteit')->findAll();
        return $this->handleView($this->view($soorten));
    }

    /**
     * @Rest\Get("/soortactiviteiten/{id}")
     */
    public function getSoortDetails(int $id) {
        $soort = $this->getDoctrine()->getRepository('App:Soortactiviteit')->find($id);
        return $this->handleView($this->view($soort));
    }

    /**
     * @Rest\Get("/activiteiten")
     */
    public function getBeschikbareActiviteiten() {
        $activiteiten = $this->getDoctrine()->getRepository('App:Activiteit')->findAll();
        return $this->handleView($this->view($activiteiten));
    }

    /**
     * @Rest\Post("/registreren")
     */
    public function registerUser(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        $data = json_decode($request->getContent(), true);
        $repository = $this->getDoctrine()->getRepository('App:User');
        $existingUsers = $repository->findBy(['username' => $data['username']]);

        if (count($existingUsers) > 0) {
            return $this->handleView($this->view(['success' => false, 'errors' => ['Gebruikersnaam in gebruik']], 401));
        }
        $data['password'] = $passwordEncoder->encodePassword(new User(), $data['plainPassword']);
        unset($data['plainPassword']);
        $data['roles'] = '["ROLE_USER"]';
        $success = $repository->createFromArray($data);

        return $this->handleView($this->view(['success' => $success], $success ? 201 : 409));
    }
}