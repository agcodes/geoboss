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
		$number = random_int(0, 100);

		return $this->render('portfolio/cv.html.twig', [
			'number' => $number,
		]);
	}

	#[Route('/portfolio/contact')]
	public function contact(LoggerInterface $logger): Response
	{
        $logger->info('I just got the logger');
		$number = random_int(0, 100);

		$testString = $this->test($logger, [], 9, 888, 888);

		return $this->render('portfolio/contact.html.twig', [
			'number' => $number,
			'testString' => $testString
		]);
	}

	private function test(LoggerInterface $logger, array $testArray, int $testInt, string $testString, float $testFloat)
	{
		$calcul = $testInt+$testFloat;
		
		return $calcul;
	}
}