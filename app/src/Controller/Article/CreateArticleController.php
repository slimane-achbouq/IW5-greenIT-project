<?php

namespace App\Controller\Article;

use App\Entity\Article;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gedmo\Sluggable\Util\Urlizer;

class CreateArticleController extends AbstractController
{
    #[Route('/dashboard/article/create', name: 'app_create_article')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form['imageFile']->getData();

            /** Upload article image */
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$imageFile->guessExtension();
                $imageFile->move(
                    $this->getParameter('articles_images_dir'),
                    $newFilename
                );
                $article->setImage($newFilename);
            }

            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success', 'Article créé avec succès !');
            return $this->redirectToRoute('app_listing_article');
        }

        return $this->render('dashboard/article/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
}
