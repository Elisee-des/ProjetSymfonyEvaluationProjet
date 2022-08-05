<?php

namespace App\Controller\Admin;

use App\Entity\Checkbox;
use App\Entity\Input;
use App\Entity\Projet;
use App\Entity\Radio;
use App\Form\CheckboxType as FormCheckboxType;
use App\Form\CreationProjetType;
use App\Form\FinalisationType;
use App\Form\InputType;
use App\Form\RadioType;
use App\Repository\CheckboxRepository;
use App\Repository\InputRepository;
use App\Repository\ProjetRepository;
use App\Repository\RadioRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/projet', name: 'admin_projet_')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();

        return $this->render('admin/projet/index.html.twig', [
            'projets' => $projets
        ]);
    }

    #[Route('/detail/{id}', name: 'detail')]
    public function deatil(Projet $projet): Response
    {

        return $this->render('admin/projet/detail.html.twig', [
            'projet' => $projet
        ]);
    }

    #[Route('/creation', name: 'creation')]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $projet = new Projet();
        $form = $this->createForm(CreationProjetType::class, $projet);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inputs = $request->get("creation_projet")["input"];
            $radios = $request->get("creation_projet")["radio"];
            $checkboxs = $request->get("creation_projet")["chexkbox"];

            $projet->setNombreInput($inputs);
            $projet->setNombreRadio($radios);
            $projet->setnombreCheckbox($checkboxs);

            $em->persist($projet);
            $em->flush();

            $this->addFlash(
                'success',
                'Vous avez parametré avec succes le projet ' . $projet->getNom() . ' Veuillez allez dans Finaliser un projet pour terminer la configuration du projet'
            );

            return $this->redirectToRoute('admin_projet_home');
        }

        return $this->render('admin/projet/creation.html.twig', [
            "projetForm" => $form->createView(),

        ]);
    }

    #[Route('/finalisation/{id}', name: 'finalisation')]
    public function finalisation(Projet $projet, InputRepository $inputRepository,
     RadioRepository $radioRepository, CheckboxRepository $checkboxRepository): Response
    {
        $inputs = $inputRepository->findAll();
        $radios = $radioRepository->findAll();
        $checkboxs = $checkboxRepository->findAll();

        return $this->render('admin/projet/finalisation.html.twig', [
            "inputs"=>$inputs,
            "radios"=>$radios,
            "checkboxs"=>$checkboxs
        ]);
    }
}
