<?php

namespace App\Controller\Create;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/create/article", name="create_article")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tab2 = [];
            preg_match_all('/blob:http:\/\/[a-zA-Z0-9.|:|\/|-]*/', $form['texte']->getData(),$tab2);
            $file = fbsql_read_blob($tab2[0]);
            dd($file);
            $em->persist($article);
            $em->flush();
        }
        return $this->render('create/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
