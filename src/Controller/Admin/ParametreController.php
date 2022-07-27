<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function modificationAcces(): Response
    {
        
        return $this->render('admin/parametre/modificaficationAcces.html.twig');
    }
}
