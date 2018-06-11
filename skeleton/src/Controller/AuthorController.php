<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\News;
use App\Services\FixturesManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AuthorController extends AbstractController
{

    /**
     * @Route("/author/add", name="author_add")
     */
    public function addAuthor(FixturesManager $fm){
        $em = $this->getDoctrine()->getManager();

        for($i = 0 ; $i < 10 ; $i++){
            $author = new Author();
            $author->setName($fm->getFaker()->name());
            $author->setFirstname($fm->getFaker()->firstname());
            $author->setDateOfBirth($fm->getFaker()->date('Y-m-d'));

            $em->persist($author);
        }

        $em->flush();

        return $this->redirectToRoute('author');



    }



    /**
     * @Route("/author", name="author")
     */
    public function index()
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->findAll();

        return $this->render('author/index.html.twig', [
            'author' => $author,
        ]);
    }

    /**
     * @Route("/author/{id}/add-news-2", name="author_add_news")
     */

    public function addNews2ToAuthor($id){
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        $news = $this->getDoctrine()->getRepository(News::class)->findOneBy(['id'=>1]);

        $author->addNews($news);

        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();

        return $this->redirectToRoute('author');
    }

    /**
     * @Route("/author/{id}", name="author_show")
     */
    public function read($id){
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        return $this->render('author/detail.html.twig',array(
            'author' => $author,
        ));
    }







}
