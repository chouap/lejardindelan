<?php

namespace App\Controller;

use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PlantRepository $plantRepository): Response
    {
        $plants = $plantRepository->findBy(
            ['isAvailable' => true], 
            ['commonName' => 'ASC'],
            8   // On limite à 8 plantes sur la page d'accueil
        );

        return $this->render('home/index.html.twig', [
            'plants' => $plants,
        ]);
    }
}