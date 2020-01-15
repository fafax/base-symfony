<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles
        ]);
    }
}
