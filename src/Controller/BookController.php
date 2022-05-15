<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{

  public function detail(int $id, BookRepository $bookRepository): Response
  {
    $book = $bookRepository->find($id);

    return $this->render('book/book_detail.html.twig', [
      'book' => $book
    ]);
  }
}