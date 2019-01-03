<?php

namespace App\Controller\UserControllers;

use App\Entity\Games;
use App\Form\GameDetailsForm;
use App\Form\GameReportForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RefereeGameController extends AbstractController{

    /**
     * @Route("/referee_game", methods = {"GET"}, name = "referee_game_list")
     */
    public function refereeGameList(Request $request){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');
        $userId = $this->getUser()->getId();

        $search_leagueName = $request->query->get('search_leagueName');

        $games = $this->getDoctrine()->getRepository(Games::class)
            ->findAllByLeagueNameReferee($request, $search_leagueName, $userId);

        return $this->render('games/game_list.html.twig', array
        ('games' => $games));
    }

    /**
     * @Route("/referee_game/details/{id}", name="referee_game_details")
     * Method({"GET", "POST"})
     */
    public function refereeGameDetails(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');
        $game = $this->getDoctrine()->getRepository(Games::class)
            ->find($id);

        $form = $this->createForm(GameDetailsForm::class, $game);

        return $this->render('games/game_details.html.twig', array
        ('form' => $form->createView()));
    }

    /**
     * @Route("/referee_game/report/{id}", name="referee_report_game")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');
        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);

        $form = $this->createForm(GameReportForm::class, $game);

        $form->handleRequest($request);

        $errors = $validator->validate($game);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Raport został zatwierdzony'
            );

            return $this->redirectToRoute('referee_game_list');
        }

        return $this->render('games/game_report.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/referee_game/confirm/{id}", name="referee_confirm_game")
     * Method({"GET", "POST"})
     */
    public function confirm(Request $request, $id, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');
        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);

        $game->setConfirmed(true);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash(
            'info',
            'Mecz został potwierdzony'
        );

        return $this->redirectToRoute('referee_game_list');
    }


}