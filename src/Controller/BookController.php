<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function create(): Response
    {
        return $this->render('book/create.html.twig');
    }
    /**
     * @Route("/{id}", name="show")
     */
    public function show(): Response
    {

    }
}
