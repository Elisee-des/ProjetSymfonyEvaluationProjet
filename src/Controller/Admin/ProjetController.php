<?php

namespace App\Controller\Admin;

use App\Entity\Checkbox;
use App\Entity\Input;
use App\Entity\InputReponse;
use App\Entity\Projet;
use App\Entity\Radio;
use App\Entity\Reponse;
use App\Form\CheckboxType as FormCheckboxType;
use App\Form\CreationProjetType;
use App\Form\FinalisationType;
use App\Form\InputReponseType;
use App\Form\InputSubmitType;
use App\Form\InputType;
use App\Form\RadioType;
use App\Repository\CheckboxRepository;
use App\Repository\InputRepository;
use App\Repository\ProjetRepository;
use App\Repository\RadioRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
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
            $reponse = new Reponse();
            $nomProjet = $request->get('creation_projet')['nom'];
            $reponse->setTitre($nomProjet);
            
            // dd($reponse);
            $em->persist($projet);
            $em->persist($reponse);
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
            "checkboxs"=>$checkboxs,
            "projet"=>$projet
        ]);
    }

    #[Route('/finalisation/{id}/input', name: 'finalisation_input')]
    public function input(Projet $projet, Request $request,
     ManagerRegistry $managerRegistry): Response
    {
        $input = new Input();
        $id = $projet->getId();
        $form = $this->createForm(InputType::class, $input);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $input->setProjet($projet);
            
            $em=$managerRegistry->getManager();
            
            $em->persist($input);
            $em->flush();

            $this->addFlash(
               'success',
               'Vous avez creé avec succes un nouveau champ de saisis'
            );
            return $this->redirectToRoute('admin_projet_finalisation', ["id"=>$id]);
        }

        return $this->render('admin/projet/titres/input.html.twig', [
            "projet"=>$projet,
            "inputForm"=>$form->createView()
        ]);
    }

    #[Route('/finalisation/{id}/input/detail/', name: 'finalisation_input_detail')]
    public function inputDetail(Request $request, Input $input, EntityManagerInterface $em): Response
    {
        $inputReponse = new InputReponse();
        $form = $this->createForm(InputReponseType::class, $inputReponse);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            // $inputReponse->setReponses($idProjet);
            $em->persist($inputReponse);
            $em->flush();
            
            $this->addFlash(
                'success',
                'Vous avez soumis avec success votre reponse'
            );
            // $idProjet = $inputReponse->getReponses()->getId();
            
            return $this->redirectToRoute('admin_projet_home');
        }

        return $this->render('admin/projet/criteres/input/detail.html.twig', [
            // "idProjet"=>$idProjet,
            "input"=>$input,
            "inputSubmitForm"=>$form->createView(),
        ]);
    }

}
