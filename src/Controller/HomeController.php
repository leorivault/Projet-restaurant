<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{

    //affiche la liste des restaurants dans la page d'acceuil 
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(RestaurantRepository $repository): Response {

        $restaurants = $repository->findAll();

        return $this->render('home.html.twig', [
            'restaurants' => $restaurants,
        ]);

    }

}