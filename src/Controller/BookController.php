<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Form\BookType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/book", name="book:")
 */
class BookController extends AbstractController
{
    /**
     * @Route("s", name="index")
     */
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    /**
     * @Route("", name="create")
     */
    public function create(Request $request): Response
    {
        $book = new Book;
       
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        $form = $form->createView();

        return $this->render('book/create.html.twig', [
            'form'=>$form
        ]);
    }
    /**
     * @Route("/{id}", name="show")
     */
    public function show(): Response
    {

    }
}
