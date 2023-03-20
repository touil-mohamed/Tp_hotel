<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Etablissement;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'app_etablissement')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $etablissementRepository = $doctrine->getRepository(Etablissement::class);
        $etablissement =  $etablissementRepository->findAll();

        return $this->render('etablissement/index.html.twig', [
            'controller_name' => 'EtablissementController',
            'etablissements' => $etablissement
        ]);
    }
}
