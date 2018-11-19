<?php
namespace App\Controller;

use App\Entity\Clubs;
use App\Form\ClubForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ClubController extends AbstractController
{

    /**
     * @Route("/club", methods = {"GET"}, name = "club_list")
     */
    public function clubList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $clubs = $this->getDoctrine()->getRepository(Clubs::class)->findAll();

        return $this->render('clubs/club_list.html.twig', array
        ('clubs' => $clubs  ));
    }
    /**
     * @Route("/club/new", methods = {"GET", "POST"}, name = "new_club")
     */
    public function newClub(Request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $club = new Clubs();

        $form = $this->createForm(ClubForm::class, $club);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $club = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('club_list');
        }

        return $this->render('clubs/new_club.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/club/edit/{id}", name="edit_club")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $club = $this->getDoctrine()->getRepository(Clubs::class)->find($id);

        $form = $this->createForm(ClubForm::class, $club);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('club_list');
        }

        return $this->render('clubs/new_club.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/club/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $club = $this->getDoctrine()->getRepository(Clubs::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($club);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}