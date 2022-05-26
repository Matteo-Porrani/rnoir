<?php

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\BookEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'some_number' => $this->getParameter('app.some_number'),
            'current_discount' => $this->getParameter('app.current_discount'),
            'multiple' => $this->getParameter('app.multiple'),
        ]);
    }

    /**
     * In this method we use the 'BookEngine' Service to shorten the summary
     * before sending it to the template
     *
     * @param BookRepository $bookRepository
     * @param BookEngine $summaryEngine
     * @return Response
     */
    public function catalog(BookRepository $bookRepository, BookEngine $bookEngine): Response
    {

        $books = $bookRepository->findAll();

        foreach ($books as $book) {
            $book = $bookEngine->shortenSummary($book);
        }

        return $this->render('home/catalog.html.twig', [
            'books' => $books
        ]);
    }

    public function new(BookRepository $bookRepository): Response
    {

        // gets ONLY books with active === 1
        $books = $bookRepository->findBy([
            'recent' => 1,
        ]);

        return $this->render('home/recent.html.twig', [
            'books' => $books,
        ]);
    }

    public function classic(): Response
    {
        return $this->render('home/classic.html.twig', []);
    }

    public function thriller(): Response
    {
        return $this->render('home/thriller.html.twig', []);
    }
}