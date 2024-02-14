<?php
// src/Controller/AppController.php
namespace App\Controller;

use App\Form\CapitalsRadioButtonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\RestCountriesService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio/cv')]
	public function cv(LoggerInterface $logger): Response
	{
        $logger->info('I just got the logger');
		$number = random_int(0, 100);

		return $this->render('portfolio/cv.html.twig', [
			'number' => $number,
		]);
	}

}