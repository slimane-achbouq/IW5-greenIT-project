<?php

namespace App\Controller\Car;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteCarController extends AbstractController
{
    #[Route('/dashboard/car/delete/{id}', name: 'app_delete_car')]
    public function index($id, EntityManagerInterface $entityManager, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);
        $entityManager->remove($car);
        $entityManager->flush();

        return $this->redirectToRoute('app_listing_car');
    }
}