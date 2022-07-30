<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\CreationUserType;
use App\Form\EditionUserType;
use App\Form\EditRoleType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateur', name: 'admin_utilisateur_')]
class UserController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('admin/user/index.html.twig', compact("users"));
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function detail(User $user): Response
    {
        $roles = $user->getRoles();

        return $this->render('admin/user/detail.html.twig', compact("user"));
    }

    #[Route('/creation', name: 'creation')]
    public function creation(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $passwordhash): Response
    {
        $user = new User();
        $form = $this->createForm(CreationUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $request->get("creation_user")["roles"][0];
            $isVerified = $request->get("creation_user")["isVerified"];
            $password = $request->get("creation_user")["password"]["first"];
            $passwordhash = $passwordhash->hashPassword($user, $password);

            $user->setRoles([$role]);
            $user->isVerified($isVerified);
            $user->setPassword($passwordhash);

            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                "Vous avez cree avec succes " . $user->getNomPrenom()
            );

            return $this->redirectToRoute('admin_utilisateur_home');
        }

        return $this->render('admin/user/creation.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('/edition/{id}', name: 'edition')]
    public function edition(User $user, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(EditionUserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                "Vous avez editer avec succes " . $user->getNomPrenom()
            );

            return $this->redirectToRoute('admin_utilisateur_home');
        }

        return $this->render('admin/user/edition.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    #[Route('/banir/{id}', name: 'banir')]
    public function banis(User $user, MailerInterface $mailerInterface, EntityManagerInterface $em): Response
    {
        $user->setRoles(["ROLE_BANIS"]);
        $em->flush();

        $email = (new TemplatedEmail())
            ->from("EvaProjet@gmail.com")
            ->to($user->getEmail())
            ->subject('Information')
            ->htmlTemplate('admin/email/emailInfo.html.twig')
            ->context(compact('user'))
        ;
        $mailerInterface->send($email);

        $this->addFlash(
           'success',
           'Vous avec banis avec success '.$user->getNomPrenom()
        );

        return $this->redirectToRoute('admin_utilisateur_home');
    }

    #[Route('/reactiver/{id}', name: 'reactiver')]
    public function reacitver(User $user, EntityManagerInterface $em): Response
    {
        $role = "ROLE_USER";
        $user->setRoles([$role]);
        $em->flush();

        $this->addFlash(
           'success',
           'Vous avec reactiver avec success '.$user->getNomPrenom()
        );

        return $this->redirectToRoute('admin_utilisateur_home');
    }

    #[Route('/suppression/{id}', name: 'supprimer')]
    public function suppression(User $user, EntityManagerInterface $em, Request $request): Response
    {
        $em->remove($user);
        $em->flush();

        $this->addFlash(
           'success',
           'Vous avez supprimer avec success '. $user->getNomPrenom()
        );

        return $this->redirectToRoute('admin_utilisateur_home');
    }

    #[Route('/modifier-le-role/{id}', name: 'role')]
    public function modifRole(User $user, EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(EditRoleType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                "Vous avez editer avec succes le role de " . $user->getNomPrenom()
            );

            return $this->redirectToRoute('admin_utilisateur_home');
        }

        return $this->render('admin/user/editRole.html.twig', [
            // compact("user"),
            "form" => $form->createView(),
        ]);
    }

        #[Route('/importation', name: 'importation')]
        public function importation(UserRepository $userRepository): Response
        {
            $users = $userRepository->findAll();
    
            return $this->render('admin/user/index.html.twig', compact("users"));
        }
}
