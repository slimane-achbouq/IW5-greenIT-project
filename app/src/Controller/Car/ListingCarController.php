<?php

namespace App\Controller\Car;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingCarController extends AbstractController
{
    #[Route('/dashboard/car/listing', name: 'app_listing_car')]
    public function index(Request $request, CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();
        return $this->render('dashboard/car/listing.html.twig', [
            'cars' => $cars,
        ]);

    }
}