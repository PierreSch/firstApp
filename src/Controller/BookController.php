<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/book", name="book:")
 */
class BookController extends AbstractController
{
    /**
     * @Route("s", name="index")
     */
    public function index(BookRepository $bookRepository): Response
    {
        $books =$bookRepository->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }
    /**
     * @Route("", name="create")
     */
    public function create(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        $book = new Book;
       
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if( $form->isSubmitted() )
        {
            $validator->validate($book);

            if( $form->isValid() )
            {
                //enregistrement BDD
                 $em = $doctrine->getManager();
                 $em->persist( $book );
                 $em->flush(); 

                //Message de succes
                $this->addFlash('success', "Le livre ".$book->getTitle()." à été ajouté.");

                //redirection
                return $this->redirectToRoute("book:index");
            }
            
        }

        $form = $form->createView();

        return $this->render('book/create.html.twig', [
            'form'=>$form
        ]);
    }
    /**
     * @Route("/{id}", name="show")
     */
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig',[
                'book' => $book
        ]);
    }
    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function update(Book $book,Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if( $form->isSubmitted() )
        {
            $validator->validate($book);

            if( $form->isValid() )
            {
                //enregistrement BDD
                 $em = $doctrine->getManager();
                 $em->persist( $book );
                 $em->flush(); 

                //Message de succes
                $this->addFlash('success', "Le livre ".$book->getTitle()." à été modifier.");

                //redirection
                return $this->redirectToRoute("book:index");
            }
            
        }

        $form = $form->createView();
        return $this->render('book/update.html.twig',[
            'book' => $book,
            'form' => $form,
        ]);
    }
}
