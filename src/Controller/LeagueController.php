<?php
namespace App\Controller;

use App\Entity\League;
use App\Form\LeagueForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class LeagueController extends AbstractController
{

    /**
     * @Route("/league", methods = {"GET"}, name = "league_list")
     */
    public function leagueList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $leagues = $this->getDoctrine()->getRepository(League::class)->findAll();

        return $this->render('leagues/league_list.html.twig', array
        ('leagues' => $leagues));
    }
    /**
     * @Route("/league/new", methods = {"GET", "POST"}, name = "new_league")
     */
    public function newLeague(Request $request){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $league = new League();

        $form = $this->createForm(LeagueForm::class, $league);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $league = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($league);
            $entityManager->flush();

            return $this->redirectToRoute('league_list');
        }

        return $this->render('leagues/new_league.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/league/edit/{id}", name="edit_league")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $league = $this->getDoctrine()->getRepository(League::class)->find($id);

        $form = $this->createForm(LeagueForm::class, $league);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('league_list');
        }

        return $this->render('leagues/new_league.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/league/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $league = $this->getDoctrine()->getRepository(League::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($league);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}