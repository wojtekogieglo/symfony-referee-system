<?php

namespace App\Controller\UserControllers;


use App\Entity\Referee;
use App\Form\PasswordForm;
use App\Form\ProfileForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController{

    /**
     * @Route("/profile", methods = {"GET"}, name = "profile")
     */
    public function profile(){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');

        $userId = $this->getUser()->getId();

        $referee = $this->getDoctrine()->getRepository(Referee::class)
            ->findAllByUserId($userId);

        $form = $this->createForm(ProfileForm::class, $referee);

        return $this->render('profile/profile.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/profile/password", methods = {"GET", "POST"}, name = "changePassword")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');
        $user = $this->getUser();
        $form = $this->createForm(PasswordForm::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $passwordEncoder->encodePassword(
                $user,
                $form['newPassword']->getData()
            );

            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('profile/change_password.html.twig', array(
            'form' => $form->createView()
        ));
    }
}