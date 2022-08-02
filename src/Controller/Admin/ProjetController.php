<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use App\Form\CreationProjetType;
use App\Repository\ProjetRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'projets'=>$projets
        ]);
    }

    #[Route('/creation', name: 'creation')]
    public function creation(Request $request, EntityManagerInterface $em): Response
    {
        $projet = new Projet();
        $form = $this->createForm(CreationProjetType::class, $projet);
        // $input = new Input();
        // $form1 = $this->createForm(Input::class, $input);
        // $radio = new Radio();
        // $form2 = $this->createForm(RadioType::class, $input);
        // $checkbox = new Checkbox();
        // $form3 = $this->createForm(CheckboxType::class, $input);

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
               'Vous avez Parametre avec succes le projt'.$projet->getNom().'Veuillez allez dans Finaliser un projet pour terminer la configuration du projet'
            );

            return $this->redirectToRoute('admin_projet_home');
            // $compteur1 = 0;
            // $compteur2 = 0;
            // $compteur3 = 0;
            // for ($i=0; $i < $inputs; $i++) { 

            //     $compteur1 = $compteur1 +1;
            // }

            // for ($i=0; $i < $radios; $i++) { 

            //     $compteur2 = $compteur2 +1;
            // }

            // for ($i=0; $i < $checkboxs; $i++) { 

            //     $compteur3 = $compteur3 +1;
            // }
            // dd($compteur1, $compteur2, $compteur3);

        }

        return $this->render('admin/projet/creation.html.twig', [
            "projetForm"=>$form->createView(),
            // "inputForm"=>$form1->createView(),
            // "radioForm"=>$form2->createView(),
            // "checkboxForm"=>$form3->createView(),
        ]);
    }
}
