<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\CreationUserType;
use App\Form\EditionUserType;
use App\Form\EditRoleType;
use App\Form\ImportationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/projet', name: 'admin_projet_')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('admin/projet/index.html.twig');
    }
}
