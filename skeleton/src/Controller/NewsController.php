<?php

namespace App\Controller;

use App\Entity\News;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends AbstractController
{

    /**
     * @Route("/news/add", name="news_add");
     */
    public function add(FixturesManager $fm)
    {
        $em = $this->getDoctrine()->getManager();

        for ($i = 0; $i < 10; $i++) {
            $news = new News();
            $news->setTitle($fm->getFaker()->text(5));
            $news->setContent($fm->getFaker()->paragraph(1));
            $news->setPublicationDate($fm->getFaker()->date('y-m-d'));
            $news->setImageUrl($fm->getFaker()->imageUrl(300,150));

            $em->persist($news);

        }

        $em->flush();

        return $this->redirectToRoute('news');


    }


    /**
     * @Route("/news", name="news")
     */
    public function index()
    {

        $news = $this->getDoctrine()->getRepository(News::class)->findAll();
        return $this->render('news/index.html.twig', [
            'news' => $news,
        ]);
    }
}
