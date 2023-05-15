<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration', methods: ['GET', 'POST'])]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $entityManager = $doctrine->getManager();

            $plainPassword = $form->get('plainPassword')->getData();

            
            
            $password = $hasher->hashPassword(
                $user,
                $plainPassword
            );

            $user->setPassword($password);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('registration_success');

        }



        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/registration/success', name : 'registration_success')]
    public function success() : Response {

        return $this->render('registration/success.html.twig');
    
    }
}
