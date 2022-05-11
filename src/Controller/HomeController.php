<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home_index")
   */
  public function index(): Response
  {
    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
    ]);
  }

  /**
   * @Route("/new", name="home_new")
   */
  public function new(): Response
  {
    return $this->render('home/new.html.twig', [
      'controller_name' => 'HomeController',
    ]);
  }
}