<?php

namespace App\Controller\Article;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ListingArticleController extends AbstractController
{
    #[Route('/dashboard/article/listing', name: 'app_listing_article')]
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('dashboard/article/listing.html.twig', [
            'articles' => $articles,
        ]);

    }
    #[Route('/api/articles', name: 'api_articles')]
    public function getHomePageArticles(Request $request, ArticleRepository $articleRepository, SerializerInterface $serializer): Response
    {
        $articles = $articleRepository->findBy([], ['id' => 'DESC'], 3, 0);
        $jsonContent = $serializer->serialize($articles, JsonEncoder::FORMAT);

        return new Response($jsonContent, 200, ['Content-Type' => 'application/json;charset=UTF-8']);
    }
}