<?php

namespace App\Controller;

use App\Entity\Plant;
use App\Repository\PlantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlantController extends AbstractController
{
    #[Route('/galerie', name: 'plant_galerie')]
    public function galerie(PlantRepository $plantRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        if ($search) {
            $plants = $plantRepository->findBySearch($search);
        } else {
            $plants = $plantRepository->findAll();
        }

        return $this->render('plant/galerie.html.twig', [
            'plants' => $plants,
            'search' => $search,
        ]);
    }

    #[Route('/plant/{slug}', name: 'plant_show')]
    public function show(Plant $plant): Response
    {
        return $this->render('plant/show.html.twig', [
            'plant' => $plant,
        ]);
    }
}