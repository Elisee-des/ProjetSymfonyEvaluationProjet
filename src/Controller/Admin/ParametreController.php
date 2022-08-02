<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ModifAccesType;
use App\Form\ModifPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/parametre', name: 'admin_parametre_')]
class ParametreController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('admin/parametre/index.html.twig');
    }

    #[Route('/modification/acces', name: 'modification_acces')]
    public function modificationAcces(Request $request, EntityManagerInterface $em): Response
    {
        /**
         * @var User
         */

        $user = $this->getUser();

        $form = $this->createForm(ModifAccesType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $nomPrenom = $request->get("modif_acces")["nomPrenom"]; 

            $user->setNomPrenom($nomPrenom);

            $em->persist($user);
            $em->flush();

            $this->addFlash(
               'success',
               'Votre nom et prenom a ete modifier'
            );

            return $this->redirectToRoute('parametre_home');
        }

        return $this->render('admin/parametre/modificaficationAcces.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/modification/mot-de-passe', name: 'modification_mot_de_passe')]
    public function modifPassword(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        /**
         * @var User
        */

        $user = $this->getUser();

        $form = $this->createForm(ModifPasswordType::class, $user);

        $formaulaire = $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $formaulaire->get("password")->getData();
            $passwordhash = $userPasswordHasherInterface->hashPassword($user, $password);
            $user->setPassword($passwordhash);

            $em->persist($user);
            $em->flush();

            $this->addFlash(
               'success',
               'Votre mot de passe a ete modifier avec success'
            );

            return $this->redirectToRoute('parametre_home');
        }

        return $this->render('admin/parametre/modifiacationPassword.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
