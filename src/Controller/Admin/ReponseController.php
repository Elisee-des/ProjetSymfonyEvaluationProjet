<?php

namespace App\Controller\Admin;

use App\Entity\Checkbox;
use App\Entity\Input;
use App\Entity\Radio;
use App\Entity\Reponse;
use App\Form\CheckboxType as FormCheckboxType;
use App\Form\CreationreponseType;
use App\Form\FinalisationType;
use App\Form\InputReponseType;
use App\Form\InputSubmitType;
use App\Form\InputType;
use App\Form\RadioType;
use App\Repository\CheckboxRepository;
use App\Repository\InputRepository;
use App\Repository\RadioRepository;
use App\Repository\ReponseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/reponse', name: 'admin_reponse_')]
class ReponseController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ReponseRepository $reponseRepository): Response
    {
        $reponses = $reponseRepository->findAll();

        return $this->render('admin/reponse/index.html.twig', [
            'reponses' => $reponses
        ]);
    }

    #[Route('/detail', name: 'detail')]
    public function detail(ReponseRepository $reponseRepository): Response
    {

        return $this->render('admin/reponse/detail.html.twig', [
        ]);
    }

}
