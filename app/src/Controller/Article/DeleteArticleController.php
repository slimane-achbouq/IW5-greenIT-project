<?php

namespace App\Controller\Article;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteArticleController extends AbstractController
{
    #[Route('/dashboard/article/delete/{id}', name: 'app_delete_article')]
    public function index($id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('app_listing_article');
    }
}