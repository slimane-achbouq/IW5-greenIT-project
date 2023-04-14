<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();
        return $this->render('home_page.html.twig', [
            'cars' => $cars
        ]);
    }

    #[Route('/audi-Q7', name: 'app_audi-Q7')]
    public function carPage(): Response
    {
        return $this->render('car_page.html.twig');
    }
}
