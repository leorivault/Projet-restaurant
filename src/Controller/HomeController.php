<?php

namespace App\Controller;

use App\Entity\RestaurantSearch;
use App\Form\RestaurantSearchType;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController

{

    //affiche la liste des restaurants dans la page d'acceuil 
    #[Route('/', 'home.index', methods: ['GET'])]
    public function index(RestaurantRepository $repository, Request $request): Response {

        $search = new RestaurantSearch();

        $form = $this->createForm(RestaurantSearchType::class, $search);
        $form->handleRequest($request);

        $restaurants = $repository->findAll();

        return $this->render('home.html.twig', [
            'restaurants' => $restaurants,
            'form' => $form->createView(),
        ]);

    }

}