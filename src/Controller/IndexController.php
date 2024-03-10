<?php
// src/Controller/AppController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    #[Route('/')]
	public function index(): Response
	{
		return $this->render('index/index.html.twig');
	}
}