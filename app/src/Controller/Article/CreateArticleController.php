<?php

namespace App\Controller\Article;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class CreateArticleController extends AbstractController
{
    #[Route('/create/article', name: 'app_create_article')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();

        return $this->render('dashboard/article/create.html.twig', [
            'controller_name' => 'CreateArticleController',
        ]);
    }
}
