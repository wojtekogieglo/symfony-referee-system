<?php
namespace App\Controller;

use App\Entity\Referee;
use App\Entity\User;
use App\Form\RefereeForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RefereeController extends AbstractController
{
    /**
     * @Route("/referee", methods = {"GET"}, name = "referee_list")
     */
    public function refereeList(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $referees = $this->getDoctrine()->getRepository(Referee::class)->findAll();

        return $this->render('referees/referee_list.html.twig', array
        ('referees' => $referees  ));
    }

    /**
     * @Route("/referee/new", methods = {"GET", "POST"}, name = "new_referee")
     */
    public function newReferee(Request $request, UserPasswordEncoderInterface $passwordEncoder, ValidatorInterface $validator){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $referee = new Referee();
        $user = new User();

        $form = $this->createForm(RefereeForm::class, $referee);

        $form->handleRequest($request);

        $errors = $validator->validate($referee);

        if($form->isSubmitted() && $form->isValid()){
            $referee = $form->getData();
            $user->setEmail($form["email"]->getData());
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                'user'
            ));
            $user->setRoles(array('ROLE_REFEREE'));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $referee->setUserId($user);
            $entityManager->persist($referee);
            $entityManager->flush();

            return $this->redirectToRoute('referee_list');
        }

        return $this->render('referees/new_referee.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/referee/edit/{id}", name="edit_referee")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $referee = $this->getDoctrine()->getRepository(Referee::class)->find($id);
        $user = $this->getDoctrine()->getRepository(User::class)->find($referee->getUserId());


        $form = $this->createForm(RefereeForm::class, $referee);
        $form->get('email')->setData($user->getEmail());
        $form->handleRequest($request);

        $errors = $validator->validate($referee);

        if($form->isSubmitted() && $form->isValid()){
            $user->setEmail($form["email"]->getData());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('referee_list');
        }

        return $this->render('referees/new_referee.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/referee/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $referee = $this->getDoctrine()->getRepository(Referee::class)->find($id);
        $user = $this->getDoctrine()->getRepository(User::class)->find($referee->getUserId());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($referee);
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

}