<?php
// src/Controller/AppController.php
namespace App\Controller;

use App\Form\CapitalsRadioButtonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\RestCountriesService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
		RestCountriesService $restCountriesService
	): Response {

		$previousGoodAnswer = '';
		$previousCountry = '';
		$isSubmitted = false;
		$isGood = false;

		if ($request->getContent() != null) {
			$formData = $request->request->all();
			if (isset($formData['capitals_radio_button_form']['country_name'])) {
				$previousCountry = $formData['capitals_radio_button_form']['country_name'];
				$country = $restCountriesService->getCountry($previousCountry);
				$previousGoodAnswer = $country->capital;
				$isSubmitted = true;
				
				$isGood =  (isset($formData['capitals_radio_button_form']['selectedOption']))
				&& ($formData['capitals_radio_button_form']['selectedOption'] == $previousGoodAnswer);
			}
		}

		$countries = $restCountriesService->getRandomCountries(4);
		if (empty($countries)){
			throw new \Exception('Something went wrong!');
		}
		$savedCountry = $countries[0];

		shuffle($countries);
		
		$choices = [];
		foreach ($countries as $country) {
			$choices[$country->capital] = $country->capital;
		}

		$form = $this->createForm(CapitalsRadioButtonFormType::class, null, [
			'choices' => $choices,
			'country_name' => $savedCountry->name,
			'method' => 'POST'
		]);

		return $this->render('capitals-quiz.html.twig', [
			'country' => $savedCountry,
			'form' => $form->createView(),
			'isSubmitted' => $isSubmitted,
			'isGood' => $isGood,
			'previousGoodAnswer' => $previousGoodAnswer,
			'previousCountry'=>$previousCountry
		]);
	}
}
