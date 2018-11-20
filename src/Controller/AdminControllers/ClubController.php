<?php
namespace App\Controller\AdminControllers;

use App\Entity\Clubs;
use App\Form\ClubForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ClubController extends AbstractController
{

    /**
     * @Route("/club", methods = {"GET", "POST"}, name = "club_list")
     */
    public function clubList(Request $request){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $searchName = $request->query->get('search_name');

        $clubs = $this->getDoctrine()->getRepository(Clubs::class)->findAllByClubName($request, $searchName);

        return $this->render('clubs/club_list.html.twig', array
        ('clubs' => $clubs  ));
    }
    /**
     * @Route("/club/new", methods = {"GET", "POST"}, name = "new_club")
     */
    public function newClub(Request $request, ValidatorInterface $validator){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $club = new Clubs();

        $form = $this->createForm(ClubForm::class, $club);

        $form->handleRequest($request);

        $errors = $validator->validate($club);

        if($form->isSubmitted() && $form->isValid()){
            $club = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($club);
            $entityManager->flush();

            return $this->redirectToRoute('club_list');
        }

        return $this->render('clubs/new_club.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/club/edit/{id}", name="edit_club")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $club = $this->getDoctrine()->getRepository(Clubs::class)->find($id);

        $form = $this->createForm(ClubForm::class, $club);

        $form->handleRequest($request);

        $errors = $validator->validate($club);


        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('club_list');
        }

        return $this->render('clubs/new_club.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
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