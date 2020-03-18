<?php

namespace App\Controller;

use App\Entity\Activiteit;
use App\Entity\Soortactiviteit;
use App\Form\ActiviteitType;
use App\Form\SoortactiviteitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/admin/activiteiten", name="activiteitenoverzicht")
     */
    public function activiteitenOverzichtAction()
    {

        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/activiteiten.html.twig', [
            'activiteiten'=>$activiteiten
        ]);
    }

    /**
     * @Route("/admin/details/{id}", name="details")
     */
    public function detailsAction($id)
    {
        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();
        $activiteit=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);

        $deelnemers=$this->getDoctrine()
            ->getRepository('App:User')
            ->getDeelnemers($id);


        return $this->render('medewerker/details.html.twig', [
            'activiteit'=>$activiteit,
            'deelnemers'=>$deelnemers,
            'aantal'=>count($activiteiten)
        ]);
    }

    /**
     * @Route("/admin/beheer", name="beheer")
     */
    public function beheerAction()
    {
        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/beheer.html.twig', [
            'activiteiten'=>$activiteiten
        ]);
    }

    /**
     * @Route("/admin/add", name="add")
     */
    public function addAction(Request $request)
    {
        // create a user and a contact
        $a=new Activiteit();

        $form = $this->createForm(ActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"voeg toe"));
        //$form->add('reset', ResetType::class, array('label'=>"reset"));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($a);
            $em->flush();

            $this->addFlash(
                'notice',
                'activiteit toegevoegd!'
            );
            return $this->redirectToRoute('beheer');
        }
        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();
        return $this->render('medewerker/add.html.twig',array('form'=>$form->createView(),'naam'=>'toevoegen','aantal'=>count($activiteiten)
        ));
    }

    /**
     * @Route("/admin/update/{id}", name="update")
     */
    public function updateAction($id,Request $request)
    {
        $a=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);

        $form = $this->createForm(ActiviteitType::class, $a);
        $form->add('save', SubmitType::class, array('label'=>"aanpassen"));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            // tells Doctrine you want to (eventually) save the contact (no queries yet)
            $em->persist($a);


            // actually executes the queries (i.e. the INSERT query)
            $em->flush();
            $this->addFlash(
                'notice',
                'activiteit aangepast!'
            );
            return $this->redirectToRoute('beheer');
        }

        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('medewerker/add.html.twig',array('form'=>$form->createView(),'naam'=>'aanpassen','aantal'=>count($activiteiten)));
    }

    /**
     * @Route("/admin/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $a= $this->getDoctrine()
            ->getRepository('App:Activiteit')->find($id);
        $em->remove($a);
        $em->flush();

        $this->addFlash(
            'notice',
            'activiteit verwijderd!'
        );

        return $this->redirectToRoute('beheer');
    }

    /**
     * @Route("/admin/soort", name="soort_index")
     */
    public function soortIndex() {
        $soorten = $this->getDoctrine()->getRepository('App:Soortactiviteit')->findAll();
        $activiteiten = $this->getDoctrine()->getRepository('App:Activiteit')->findAll();

        return $this->render('medewerker/soort.html.twig', [
            'soorten' => $soorten,
            'aantal' => count($activiteiten)
        ]);
    }

    /**
     * @Route("/admin/soort/new", name="new_soort")
     */
    public function newSoort(Request $request) {
        $soort = new Soortactiviteit();
        $form = $this->createForm(SoortactiviteitType::class, $soort);
        $form->add('save', SubmitType::class, array('label' => 'Maak'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($soort);
            $em->flush();

            $this->addFlash(
                'notice',
                'soort toegevoegd!'
            );

            return $this->redirectToRoute('soort_index');
        }

        $activiteiten = $this->getDoctrine()->getRepository('App:Activiteit')->findAll();
        return $this->render('medewerker/soort_form.html.twig', array(
            'form' => $form->createView(),
            'naam' => 'toevoegen',
            'aantal' => count($activiteiten))
        );
    }

    /**
     * @Route("/admin/soort/{id}/edit", name="edit_soort")
     */
    public function editSoort(int $id, Request $request) {
        $soort = $this->getDoctrine()->getRepository('App:Soortactiviteit')->find($id);
        $form = $this->createForm(SoortactiviteitType::class, $soort);
        $form->add('save', SubmitType::class, array('label' => 'Wijzig'));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($soort);
            $em->flush();

            $this->addFlash(
                'notice',
                'soort aangepast!'
            );

            return $this->redirectToRoute('soort_index');
        }

        $aantal = count($this->getDoctrine()->getRepository('App:Activiteit')->findAll());
        return $this->render('medewerker/soort_form.html.twig', array(
            'form'   => $form->createView(),
            'naam'   => 'wijzigen',
            'aantal' => $aantal
        ));
    }

    /**
     * @Route("/admin/soort/{id}/delete", name="delete_soort")
     */
    public function deleteSoort(int $id) {
        $em = $this->getDoctrine()->getManager();
        $soort = $this->getDoctrine()->getRepository('App:Soortactiviteit')->find($id);

        $em->remove($soort);
        $em->flush();

        $this->addFlash(
            'notice',
            'soort verwijderen!'
        );

        return $this->redirectToRoute('soort_index');
    }
}
