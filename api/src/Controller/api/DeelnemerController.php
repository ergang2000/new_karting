<?php


namespace App\Controller\api;


use App\Entity\Activiteit;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    /**
     * @Rest\Get("/activiteiten/beschikbaar")
     */
    public function getBeschikbareActiviteiten() {
        $activiteiten = $this->getDoctrine()->getRepository('App:Activiteit')->getBeschikbareActiviteiten($this->getUser()->getId());
        return $this->handleView($this->view($activiteiten));
    }

    /**
     * @Rest\Get("/activiteiten/ingeschreven")
     */
    public function getIngeschrevenActiviteiten() {
        $activiteiten = $this->getDoctrine()->getRepository('App:Activiteit')->getIngeschrevenActiviteiten($this->getUser()->getId());
        return $this->handleView($this->view($activiteiten));
    }

    /**
     * @Rest\Put("/activiteiten/{activiteit}/inschrijven")
     */
    public function inschrijven(Activiteit $activiteit)
    {
        try {
            $now = new \DateTime();
            if ($activiteit->getMaxDeelnemers() == $activiteit->getUsers()->count()) {
                throw new \Exception('deelnemers limiet bereikt!');
            }
            if ($activiteit->getDatum()->getTimestamp() < $now->getTimestamp()) {
                throw new \Exception('deadline verstreken!');
            }

            $user = $this->getUser();
            $user->addActiviteit($activiteit);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->handleView($this->view(['success' => true], 200));
        } catch (\Exception $e) {
            return $this->handleView($this->view(['success' => false, 'error' => $e->getMessage()], 400));
        }
    }

    /**
     * @Rest\Put("/activiteiten/{activiteit}/uitschrijven")
     */
    public function uitschrijven(Activiteit $activiteit)
    {
        $user = $this->getUser();
        $user->removeActiviteit($activiteit);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->handleView($this->view(['success' => true]));
    }

    /**
     * @Rest\Put("/profile")
     */
    public function updateProfile(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $success = $this->getDoctrine()->getRepository('App:User')->updateFromArray($this->getUser(), $data);

        return $this->handleView($this->view(['success' => $success], 200));
    }

    /**
     * @Rest\Put("/password")
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser();
        $password = $passwordEncoder->encodePassword($user, $data['password']);
        $user->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->handleView($this->view(['success' => true]));
    }
}