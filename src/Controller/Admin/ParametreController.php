<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ModifAccesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'parametre_')]
class ParametreController extends AbstractController
{
    #[Route('/parametre', name: 'home')]
    public function index(): Response
    {
        return $this->render('admin/parametre/index.html.twig');
    }

    #[Route('/parametre/modification/acces', name: 'modification_acces')]
    public function modificationAcces(Request $request, EntityManagerInterface $em): Response
    {
        /**
         * @var User
         */

        $user = $this->getUser();

        $form = $this->createForm(ModifAccesType::class, $user);

        $formaulaire = $form->handleRequest($request);
        
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
}
