<?php
namespace App\Controller;

use App\Entity\Clubs;
use App\Entity\Games;
use App\Form\ClubForm;
use App\Form\GamesForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class GameController extends AbstractController
{

    /**
     * @Route("/game", methods = {"GET"}, name = "game_list")
     */
    public function gameList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $games = $this->getDoctrine()->getRepository(Games::class)->findAll();

        return $this->render('games/game_list.html.twig', array
        ('games' => $games));
    }

    /**
     * @Route("/game/new", methods = {"GET", "POST"}, name = "new_game")
     */
    public function newGame(Request $request, ValidatorInterface $validator){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $game = new Games();

        $form = $this->createForm(GamesForm::class, $game);

        $form->handleRequest($request);

        $errors = $validator->validate($game);


        if($form->isSubmitted() && $form->isValid()){
            $game = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('game_list');
        }

        return $this->render('games/new_game.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/game/edit/{id}", name="edit_game")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);

        $form = $this->createForm(GamesForm::class, $game);

        $form->handleRequest($request);

        $errors = $validator->validate($game);

        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('game_list');
        }

        return $this->render('games/new_game.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/game/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $game = $this->getDoctrine()->getRepository(Games::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($game);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * Returns a JSON string with the neighborhoods of the City with the providen id.
     * @Route("/get-clubs-from-league", methods = {"GET"}, name = "games_list_clubs")
     * @param Request $request
     * @return JsonResponse
     */
    public function listClubsOfLeagueAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $clubsRepository = $em->getRepository(Clubs::class);

        // Search the clubs that belongs to the league with the given id as GET parameter "leagueId"
        $clubs = $clubsRepository->createQueryBuilder("q")
            ->where("q.league_id = :leagueId")
            ->setParameter("leagueId", $request->query->get("leagueId"))
            ->getQuery()
            ->getResult();

        // Serialize into an array the data that we need, in this case only name and id
        $responseArray = array();
        foreach($clubs as $club){
            $responseArray[] = array(
                "id" => $club->getId(),
                "name" => $club->getClubName()
            );
        }

        // Return array with structure of the clubs of the providen league id
        return new JsonResponse($responseArray);
    }
}