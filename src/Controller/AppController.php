<?php
// src/Controller/AppController.php
namespace App\Controller;

use App\Form\CapitalsRadioButtonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\RestCountriesService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Services\SecretService;

class AppController extends AbstractController
{
	#[Route('/index')]
	public function index(): Response
	{
		$number = random_int(0, 100);

		return $this->render('index.html.twig', [
			'number' => $number,
		]);
	}

	#[Route('/countries')]
	public function countries(RestCountriesService $restCountriesService): Response
	{
		$countries = $restCountriesService->getCountries();
		if (empty($countries)) {
			throw new \Exception('Something went wrong!');
		}
		return $this->render('countries.html.twig', [
			'countries' => $countries
		]);
	}

	#[Route('/capitals')]
	public function capitals(RestCountriesService $restCountriesService): Response
	{
		$countries = $restCountriesService->getRandomCountries(4);
		if (empty($countries)) {
			throw new \Exception('Something went wrong!');
		}
		return $this->render('capitals.html.twig', [
			'countries' => $countries
		]);
	}

	#[Route('/capitals-quiz')]
	public function capitalsQuiz(
		Request $request,
		SecretService $secretService,
		RestCountriesService $restCountriesService
	): Response {

		$previousGoodAnswer = '';
		$isSubmitted = false;
		$isGood = false;

		if ($request->getContent() != null) {
			$formData = $request->request->all();
			if (isset($formData['capitals_radio_button_form']['secretAnswer'])) {
				$previousGoodAnswer = $secretService->decryptIt($formData['capitals_radio_button_form']['secretAnswer']);

				$isSubmitted = true;
				if (isset($formData['capitals_radio_button_form']['selectedOption'])) {
					if ($formData['capitals_radio_button_form']['selectedOption'] == $previousGoodAnswer) {
						$isGood = true;
					} else {
						$isGood = false;
					}
				}
			}
		}

		
		$choices = [];

		$countries = $restCountriesService->getRandomCountries(4);
		if (empty($countries)){
			throw new \Exception('Something went wrong!');
		}
		$savedCountry = $countries[0];
		$secretCapital = $secretService->encryptIt($savedCountry->capital);

		shuffle($countries);
		foreach ($countries as $country) {
			$choices[$country->capital] = $country->capital;
		}

		$form = $this->createForm(CapitalsRadioButtonFormType::class, null, [
			'choices' => $choices,
			'secretAnswer' => $secretCapital,
			'method' => 'POST'
		]);

		return $this->render('capitals-quiz.html.twig', [
			'country' => $savedCountry,
			'form' => $form->createView(),
			'isSubmitted' => $isSubmitted,
			'isGood' => $isGood,
			'previousGoodAnswer' => $previousGoodAnswer
		]);
	}
}
