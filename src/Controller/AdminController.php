<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
  public function index(BookRepository $bookRepository, Request $request): Response
  {
    $books = $bookRepository->findAll();

    if ($request->getMethod() === 'POST') {
      $activeIds = $request->request->all();

      foreach ($activeIds as $id => $value) {
        // QUERY 'SELECT'
        $book = $bookRepository->find($id);
        // QUERY 'UPDATE'
        if ($value === 'ACT') {
          $bookRepository->activateBook($book);
        } else {
          $bookRepository->deactivateBook($book);
        }
      }
    }

    return $this->render('admin/index.html.twig', [
      'books' => $books,
    ]);
  }

  public function bookForm(Book $book = null, Request $request, EntityManagerInterface $manager): Response
  {

    if ($book === null) {
      $book = new Book();
    }

    // form creation
    $form = $this->createForm(BookType::class, $book);

    // form handling
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $manager->persist($book);
      $manager->flush();

      return $this->redirectToRoute('admin_index');
    }

    return $this->render('book/book_form.html.twig', [
      'form' => $form->createView()
    ]);
  }
}